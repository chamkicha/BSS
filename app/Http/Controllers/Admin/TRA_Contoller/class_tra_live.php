<?php
/*******************************************************
 * Copyright (C) 2020 NIDC 
 * 
 * This file is part of TRA integration API.
 * 
 * This source can not be copied and/or distributed without the express
 * permission of the owner 
 *******************************************************/

class tra_class_live extends CRUD
{                        //Request message Object
    protected $db;

    function __construct($db)
    {
        //Set the database connection and recieve the transaction request message
        $this->db = $db;
    }
    public function log_event($msgType, $text)
    {
        $now = new DateTime();
        $now12 = new DateTime();
        $now = $now->format('Y-m-d H:i:s');
        $today = $now12->format('Y-m-d');
        $logs = 'logsTRALive-' . $today . '.txt';
        $file = '../logs/' . $logs . '';
        //Open the file to get existing content
        if (file_exists($file)) {
            $current = file_get_contents($file);
            $current .= "$now-$msgType-$text \n";
        } else $current = "$now-$msgType-$text \n";
        // Write the contents back to the file
        file_put_contents($file, $current);
    }
    public function process_xml_response($values)
    {
        $xml = new SimpleXMLElement($values);
        $json = json_encode($xml);
        $xml = json_decode($json, TRUE);
        return $xml['EFDMSRESP'];
    }
    public function processTraReceipt($tin, $amount, $mobile)
    {

        $tra_details = $this->get_tra_details_conf($tin);
        if (empty($tra_details[6]) || empty($tra_details[7])) {
            $this->log_event('NOTREG', $tin);
            $reg_xml = $this->post_tra_reg($tra_details);
            //print_r($reg_xml);
            $reg_data = $this->process_xml_response($reg_xml);
            //print_r($reg_data);
            $this->log_event('REG-TRA-DATA', $reg_data['RECEIPTCODE'] . ',' . $reg_data['USERNAME'] . ',' . $reg_data['PASSWORD']);
            $TRA = $reg_data['RECEIPTCODE'] . $this->get_count_gc($reg_data['TIN']);
            $this->update_tra_config_details($reg_data);
            $tokenAuth = $this->get_auth_token($reg_data['USERNAME'], $reg_data['PASSWORD']);
            $tra_details = $this->get_tra_details_conf($tin);
        } else {
            $this->log_event('REG', $tin . ', ' . $tra_details[7] . ', ' . $tra_details[6]);
            $TRA = $tra_details[9] . $this->get_count_gc($tra_details[0]);
            $tokenAuth = $this->get_auth_token($tra_details[7], $tra_details[8]);
        }

        $this->send_efdrec_request_tra($tra_details, $tokenAuth['token_type'], $tokenAuth['access_token'], 'Abiria', $mobile, $amount);

        return $TRA;
    }

    public function get_tra_details_conf($tin)
    {
        $tin = str_replace("-", "", $tin);
        $sql = "SELECT `tin_num`, `vfd`, `cert_path`, `cert_password`, `cert_serial`,`datetime`
			  ,`regid`, `username`, `password`, `recptcode`, `routekey`, `access_token`, `datetime`			  
			  FROM `tbl_tra_customer_configurations` 
			  WHERE `tin_num`=:tin";
        try {
            $sql = $this->db->prepare($sql);
            $sql->bindParam(':tin', trim($tin));
            $sql->execute();
            $result = $sql->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $result;
    }
    public function post_tra_reg($data_tra)
    {
        $tin = str_replace("-", "", $data_tra[0]);
        $vfd = $data_tra[1];
        $path = $data_tra[2];
        $password = $data_tra[3];
        $cert_serial = base64_encode($data_tra[4]);
        $this->log_event('REG-DATA', $tin . ', ' . $vfd . ', ' . $path . ', ' . $password . ', ' . $cert_serial);
        $payload = '<REGDATA><TIN>' . $tin . '</TIN><CERTKEY>' . $vfd . '</CERTKEY></REGDATA>';
        $this->log_event('REG-REQ', $payload);
        $priv_key = $this->get_key_from_file("../$path.pem", true, true, $password);
        $signedPayload = $this->sign_payload_plain($payload, $priv_key);
        $reg_xml = '<EFDMS>
					' . $payload . '
					<EFDMSSIGNATURE>
					' . $signedPayload . '
					</EFDMSSIGNATURE>
				</EFDMS>';
        $reg_resp = $this->send_reg_request_tra($reg_xml, $cert_serial);
        return $reg_resp;
    }
    public function send_reg_request_tra($xml, $cert_serial)
    {
        $response = false;
        //1. Prepare the connectivity parameters.
        $url = "https://vfd.tra.go.tz/api/vfdRegReq";
        //3.Send the Request to the API
        try {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_POST => 1,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => array('Content-Type: application/xml', 'Cert-Serial:' . $cert_serial . '', 'Client:WEBAPI'),
                CURLOPT_URL => "$url",
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_POSTFIELDS => $xml,
                CURLOPT_CONNECTTIMEOUT => 0,
                CURLOPT_TIMEOUT => 65
            ));

            $resp = curl_exec($curl);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            if (FALSE === $resp) {
                throw new Exception(curl_error($curl), curl_errno($curl));
            }
            curl_close($curl);
        } catch (Exception $e) {
            //trigger_error(sprintf('Curl failed with error #%d: %s',	$e->getCode(), $e->getMessage()),E_USER_ERROR);

        }
        //4. Parse the Server Response
        $resp = trim($resp);
        $response = '';
        if ($httpCode == 200) {
            $response = $resp;
        } else {
            $response = false;
        }
        return $response;
    }
    public function update_tra_config_details($details)
    {
        $sql = "UPDATE `tbl_tra_customer_configurations` SET 
				`regid`=:regid,`username`=:username,`password`=:password,`recptcode`=:recode,`routekey`=:rtkey, `datetime`=NOW()
				WHERE `tin_num`=:tin AND `vfd`=:vfd";
        $parameters = array(
            ':tin' => $details['TIN'],
            ':vfd' => $details['SERIAL'],
            ':regid' => $details['REGID'],
            ':username' => $details['USERNAME'],
            ':password' => $details['PASSWORD'],
            ':recode' => $details['RECEIPTCODE'],
            ':rtkey' => $details['ROUTINGKEY']
        );
        $this->execute_query($sql, $parameters);
    }

    //get key from file
    public function get_key_from_file($certficatePath, $isPrivateKey, $protected, $password)
    {
        //echo 'get_key_from_file-'.$certficatePath.'<br>';
        $this->log_event('PATH', $certficatePath);
        $fp = fopen($certficatePath, "r");
        $p_key = fread($fp, 8192);
        fclose($fp);
        if ($isPrivateKey == true) {
            //return openssl_get_privatekey($p_key);
            if ($protected == true) {
                return openssl_get_privatekey($p_key, $password);
            } else {
                return openssl_get_privatekey($p_key);
            }
        } else {
            //return openssl_get_publickey($p_key);
            if ($protected == true) {
                return openssl_get_publickey($p_key, $password);
            } else {
                return openssl_get_publickey($p_key);
            }
        }
    }
    //Sign payload
    public function sign_payload_plain($payload_data, $key)
    {
        //compute signature with SHA-256
        openssl_sign($payload_data, $signature, $key, OPENSSL_ALGO_SHA1);
        return base64_encode($signature);
    }
    public function get_auth_token($username, $password)
    {
        $postData = "username=$username&password=$password&grant_type=password";
        $this->log_event('TOKEN-Deta', $postData);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://vfd.tra.go.tz/vfdtoken");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
        // receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $resp = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $resp = trim($resp);
        $response = '';
        if ($httpCode == 200) {
            $resp = json_decode($resp, true);
            $response = $resp;
        } else {
            $response = '';
        }
        return $response;
    }
    public function get_receipt_posted_data($reg_data, $name, $mobile, $amount)
    {

        $gc = $this->get_count($reg_data[0], 'gc');
        $dc = $this->get_count($reg_data[0], 'dc');
        $rctvnum = $reg_data[9] . $gc;
        $payload = '<RCT><DATE>' . date('Y-m-d') . '</DATE><TIME>' . date('H:i:s') . '</TIME><TIN>' . $reg_data[0] . '</TIN><REGID>' . $reg_data[6] . '</REGID><EFDSERIAL>' . $reg_data[1] . '</EFDSERIAL><CUSTIDTYPE>6</CUSTIDTYPE><CUSTID></CUSTID><CUSTNAME>' . $name . '</CUSTNAME><MOBILENUM>' . $mobile . '</MOBILENUM><RCTNUM>' . $gc . '</RCTNUM><DC>' . $dc . '</DC><GC>' . $gc . '</GC><ZNUM>' . date('Ymd') . '</ZNUM><RCTVNUM>' . $rctvnum . '</RCTVNUM><ITEMS><ITEM><ID>1</ID><DESC>Nauli ya bus</DESC><QTY>1</QTY><TAXCODE>3</TAXCODE><AMT>' . $amount . '</AMT></ITEM></ITEMS><TOTALS><TOTALTAXEXCL>' . $amount . '</TOTALTAXEXCL><TOTALTAXINCL>' . $amount . '</TOTALTAXINCL><DISCOUNT>0.00</DISCOUNT></TOTALS><PAYMENTS><PMTTYPE>EMONEY</PMTTYPE><PMTAMOUNT>' . $amount . '</PMTAMOUNT></PAYMENTS><VATTOTALS><VATRATE>C</VATRATE><NETTAMOUNT>' . $amount . '</NETTAMOUNT><TAXAMOUNT>0</TAXAMOUNT></VATTOTALS></RCT>';
        $this->log_event('RECP-REQ', $payload);
        $priv_key = $this->get_key_from_file("../" . $reg_data[2] . ".pem", true, true, $reg_data[3]);
        $signedPayload = $this->sign_payload_plain($payload, $priv_key);
        $recXML = "<EFDMS>
					$payload
					<EFDMSSIGNATURE>
					$signedPayload
					</EFDMSSIGNATURE>
				</EFDMS>";
        $this->log_event('RCPT-DT', $recXML);
        return $recXML;
    }
    public function send_efdrec_request_tra($reg_data, $token_type, $access_token, $name, $mobile,  $amount)
    {
        $response = false;
        $xmlReq = $this->get_receipt_posted_data($reg_data, $name, $mobile, $amount);
        $routing_key = $reg_data[10];
        $access_token = 'Bearer ' . trim($access_token);
        $cert_serial = base64_encode($reg_data[4]);
        $headers = array();
        $headers[] = "Content-Type: application/xml";
        $headers[] = "Routing-key: vfdrct";
        $headers[] = "Authorization: $access_token";
        $headers[] = "Cert-Serial: $cert_serial";
        //1. Prepare the connectivity parameters.
        $url = "https://vfd.tra.go.tz/api/efdmsRctInfo";
        //3.Send the Request to the API
        try {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_POST => 1,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => $headers,
                CURLOPT_URL => "$url",
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_POSTFIELDS => $xmlReq,
                CURLOPT_CONNECTTIMEOUT => 0,
                CURLOPT_TIMEOUT => 65
            ));

            $resp = curl_exec($curl);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            if (FALSE === $resp) {
                throw new Exception(curl_error($curl), curl_errno($curl));
            }
            curl_close($curl);
        } catch (Exception $e) {
            //trigger_error(sprintf('Curl failed with error #%d: %s',	$e->getCode(), $e->getMessage()),E_USER_ERROR);

        }
        //4. Parse the Server Response
        $resp = trim($resp);
        $response = '';
        if ($httpCode == 200) {
            $response = $resp;
            $this->log_event('TRAREG', $response);
        } else {
            $response = false;
        }
        return $response;
    }
    public function get_count($tin, $type)
    {
        if ($type == 'dc') {
            $sql = "SELECT `dc`,`date` FROM `tbl_tra_dc` WHERE `tin_num`=:tin";
        } else {
            $sql = "SELECT `gc`,`datetime` FROM `tbl_tra_gc` WHERE `tin_num`=:tin";
        }
        try {
            $sql = $this->db->prepare($sql);
            $sql->bindParam(':tin', $tin);
            $sql->execute();
            if ($sql->rowCount() > 0) {
                //update
                $result = $sql->fetch();
                $result = $this->update_count($tin, $result[0], $result[1], $type);
            } else {
                //Insert
                $result = $this->insert_new_count($tin, $type);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $result;
    }
    public function update_count($tin, $count, $date, $type)
    {
        if ($type == 'dc') {
            if ($date != date('Y-m-d')) {
                $sql = "UPDATE `tbl_tra_dc` SET `dc`=1, date=NOW() WHERE `tin_num`=:tin";
            } else {
                $sql = "UPDATE `tbl_tra_dc` SET `dc`=`dc`+1 WHERE `tin_num`=:tin";
            }
        } else if ($type == 'gc') {
            $sql = "UPDATE `tbl_tra_gc` SET `gc`=gc+1 WHERE `tin_num`=:tin";
        }
        try {
            $sql = $this->db->prepare($sql);
            $sql->bindParam(':tin', $tin);
            if ($sql->execute()) {
                $sql = "SELECT $type FROM tbl_tra_$type WHERE `tin_num`=:tin";
                $sql = $this->db->prepare($sql);
                $sql->bindParam(':tin', $tin);
                $sql->execute();
                $result = $sql->fetch();
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return $result[0];
    }
    public function insert_new_count($tin, $type)
    {
        if ($type == 'dc') {
            $sql = "INSERT INTO `tbl_tra_dc`
				(`dc`, `tin_num`, `date`) 
				VALUES
				(1,:tin,NOW())";
        } else if ($type == 'gc') {
            $sql = "INSERT INTO `tbl_tra_gc`
					(`gc`, `tin_num`) 
					VALUES
					(1,:tin)";
        }
        try {
            $sql = $this->db->prepare($sql);
            $sql->bindParam(':tin', $tin);
            if ($sql->execute()) {
                $sql = "SELECT $type FROM tbl_tra_$type WHERE `tin_num`=:tin";
                $sql = $this->db->prepare($sql);
                $sql->bindParam(':tin', $tin);
                $sql->execute();
                $result = $sql->fetch();
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $result[0];
    }
    public function get_count_gc($tin)
    {
        $sql = "SELECT `gc` FROM `tbl_tra_gc` WHERE `tin_num`=:tin";
        try {
            $sql = $this->db->prepare($sql);
            $sql->bindParam(':tin', $tin);
            $sql->execute();
            if ($sql->rowCount() > 0) {
                $result = $sql->fetch();
                $result = $result[0] + 1;
            } else {
                $result = $sql->fetch();
                $result = 0 + 1;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $result;
    }
    public function check_if_live($tin)
    {
        $sql = "SELECT is_live FROM bus_ticket.tbl_tra_customer_configurations where tin_num=:tin";
        try {
            $sql = $this->db->prepare($sql);
            $sql->bindParam(':tin', $tin);
            $sql->execute();
            $result = $sql->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $result;
    }
}
