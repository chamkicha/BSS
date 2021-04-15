<?php

namespace App\Http\Controllers\Admin\Nidc_Config_Tra;

use App\Http\Requests;
use App\Http\Requests\Nidc_Config_Tra\CreateNidcConfigRequest;
use App\Http\Requests\Nidc_Config_Tra\UpdateNidcConfigRequest;
use App\Repositories\Nidc_Config_Tra\NidcConfigRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Nidc_Config_Tra\NidcConfig;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use DB;
use Carbon\Carbon;

class NidcConfigController extends InfyOmBaseController
{
    /** @var  NidcConfigRepository */
    private $nidcConfigRepository;

    public function __construct(NidcConfigRepository $nidcConfigRepo)
    {
        $this->nidcConfigRepository = $nidcConfigRepo;
    }

    /**
     * Display a listing of the NidcConfig.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->nidcConfigRepository->pushCriteria(new RequestCriteria($request));
        $nidcConfigs = $this->nidcConfigRepository->all();
        return view('admin.nidcConfigTra.nidcConfigs.index')
            ->with('nidcConfigs', $nidcConfigs);
    }

    /**
     * Show the form for creating a new NidcConfig.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.nidcConfigTra.nidcConfigs.create');
    }

    /**
     * Store a newly created NidcConfig in storage.
     *
     * @param CreateNidcConfigRequest $request
     *
     * @return Response
     */
    public function store(CreateNidcConfigRequest $request)
    {
        $input = $request->all();

        $nidcConfig = $this->nidcConfigRepository->create($input);

        Flash::success('NidcConfig saved successfully.');

        return redirect(route('admin.nidcConfigTra.nidcConfigs.index'));
    }

    /**
     * Display the specified NidcConfig.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $nidcConfig = $this->nidcConfigRepository->findWithoutFail($id);

        if (empty($nidcConfig)) {
            Flash::error('NidcConfig not found');

            return redirect(route('nidcConfigs.index'));
        }

        return view('admin.nidcConfigTra.nidcConfigs.show')->with('nidcConfig', $nidcConfig);
    }

    /**
     * Show the form for editing the specified NidcConfig.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $nidcConfig = $this->nidcConfigRepository->findWithoutFail($id);

        if (empty($nidcConfig)) {
            Flash::error('NidcConfig not found');

            return redirect(route('nidcConfigs.index'));
        }

        return view('admin.nidcConfigTra.nidcConfigs.edit')->with('nidcConfig', $nidcConfig);
    }

    /**
     * Update the specified NidcConfig in storage.
     *
     * @param  int              $id
     * @param UpdateNidcConfigRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateNidcConfigRequest $request)
    {
        $nidcConfig = $this->nidcConfigRepository->findWithoutFail($id);

        

        if (empty($nidcConfig)) {
            Flash::error('NidcConfig not found');

            return redirect(route('nidcConfigs.index'));
        }

        $nidcConfig = $this->nidcConfigRepository->update($request->all(), $id);

        Flash::success('NidcConfig updated successfully.');

        return redirect(route('admin.nidcConfigTra.nidcConfigs.index'));
    }

    /**
     * Remove the specified NidcConfig from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.nidcConfigTra.nidcConfigs.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = NidcConfig::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.nidcConfigTra.nidcConfigs.index'))->with('success', Lang::get('message.success.delete'));

       }

       public function processTraReceipt(Request $request)
       {
           //dd($request);
           $tra_details= DB::table('nidcconfigs')->get();
           $tin = str_replace("-", "", $tra_details[0]->tin_num);
           $TRA = $tra_details[0]->password . $this->get_count_gc($tra_details[0]->tin_num);
           $tokenAuth = $this->get_auth_token($tra_details[0]->username, $tra_details[0]->password);
   
           $this->send_efdrec_request_tra($tra_details, $tokenAuth['token_type'], $tokenAuth['access_token'], $request->cusromer_name, $request->mobile_number, $request->grand_total);
   
           return $TRA;
       }

       
    public function send_efdrec_request_tra($reg_data, $token_type, $access_token, $name, $mobile,  $amount)
    {
        $response = false;
        $xmlReq = $this->get_receipt_posted_data($reg_data, $name, $mobile, $amount);
        $routing_key = $reg_data[0]->routekey;
        $access_token = 'Bearer ' . trim($access_token);
        $cert_serial = base64_encode($reg_data[0]->cert_serial);
        $headers = array(
           

            'Content-type: Application/xml',
            'Routing-Key: vfdrct',
            'Cert-Serial: ' .$cert_serial,
            'Client: WEBAPI',
            'Authorization: Bearer '.$access_token

        );
        //1. Prepare the connectivity parameters.
        $url = "https://virtual.tra.go.tz/efdmsRctApi/api/efdmsRctInfo";
        //$url = "https://vfd.tra.go.tz/api/efdmsRctInfo";
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
        dd($resp);
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
        dd($response);
        return $response;
    }

    
    public function get_receipt_posted_data($reg_data, $name, $mobile, $amount)
    {
        $tin = str_replace("-", "", $reg_data[0]->tin_num);
        $gc = $this->get_count($reg_data[0], 'gc');
        $dc = $this->get_count($reg_data[0], 'dc');
        $rctvnum = $reg_data[0]->recptcode . $gc;
        $payload = '<RCT><DATE>' . date('Y-m-d') . '</DATE><TIME>' . date('H:i:s') . '</TIME><TIN>' . $tin . '</TIN><REGID>' . $reg_data[0]->regid . '</REGID><EFDSERIAL>' . $reg_data[0]->vfd . '</EFDSERIAL><CUSTIDTYPE>1</CUSTIDTYPE><CUSTID></CUSTID><CUSTNAME>' . $name . '</CUSTNAME><MOBILENUM>' . $mobile . '</MOBILENUM><RCTNUM>' . $gc . '</RCTNUM><DC>' . $dc . '</DC><GC>' . $gc . '</GC><ZNUM>' . date('Ymd') . '</ZNUM><RCTVNUM>' . $rctvnum . '</RCTVNUM><ITEMS><ITEM><ID>1</ID><DESC>Nauli ya bus</DESC><QTY>1</QTY><TAXCODE>3</TAXCODE><AMT>' . $amount . '</AMT></ITEM></ITEMS><TOTALS><TOTALTAXEXCL>' . $amount . '</TOTALTAXEXCL><TOTALTAXINCL>' . $amount . '</TOTALTAXINCL><DISCOUNT>0.00</DISCOUNT></TOTALS><PAYMENTS><PMTTYPE>EMONEY</PMTTYPE><PMTAMOUNT>' . $amount . '</PMTAMOUNT></PAYMENTS><VATTOTALS><VATRATE>C</VATRATE><NETTAMOUNT>' . $amount . '</NETTAMOUNT><TAXAMOUNT>0</TAXAMOUNT></VATTOTALS></RCT>';
        $priv_key = $this->get_key_from_file("./" . $reg_data[0]->cert_path . ".pem", true, true, $reg_data[0]->cert_password);
        $signedPayload = $this->sign_payload_plain($payload, $priv_key);
        dd($priv_key);
        $recXML = "<EFDMS>
					$payload
					<EFDMSSIGNATURE>
					$signedPayload
					</EFDMSSIGNATURE>
				</EFDMS>";
        return $recXML;
    }

    
    public function get_count($tin, $type)
    {
        if ($type == 'dc') {
            $sql = DB::table('tbl_tra_dc')->where('tin_num',$tin->tin_num)->get();
             $result = $this->update_count($tin, $sql[0]->dc, $sql[0]->date, $type);
        } else {
            $result = DB::table('tbl_tra_gc')->where('tin_num',$tin->tin_num)->first()->gc;
        } 
        
        return $result;
    }

    
    public function update_count($tin, $count, $date, $type)
    {
        //$datee=Carbon::now()->format('Y-m-d');
        
        if ($type == 'dc') {
            if ($date != date('Y-m-d')) {
                $sql = DB::table('tbl_tra_dc')->where('tin_num',$tin->tin_num)->update(['dc'=>'1' ,'date'=>date('Y-m-d')]);
                $result = DB::table('tbl_tra_dc')->where('tin_num',$tin->tin_num)->first()->dc;
            } else {
                $sql = DB::table('tbl_tra_dc')->where('tin_num',$tin->tin_num)->first()->dc;
                $result = $sql +1;
                $sql = DB::table('tbl_tra_dc')->where('tin_num',$tin->tin_num)->update(['dc'=>$result]);
            }
        } 

        return $result;
    }

       
    public function get_auth_token($username, $password)
    {
        $postData = "username=$username&password=$password&grant_type=password";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://virtual.tra.go.tz/efdmsRctApi/vfdtoken");
        // curl_setopt($ch, CURLOPT_URL, "https://vfd.tra.go.tz/vfdtoken"); LIVE
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

       
    public function get_count_gc($tin)
    {
        $sql = DB::table('tbl_tra_gc')->where('tin_num',$tin)->get();
        
        $result = $sql[0]->gc + 1;
        $sql_update = DB::table('tbl_tra_gc')->where('tin_num',$tin)->update(['gc' => $result]);
        
        return $result;
    }

       

    public function post_tra_reg()
    {
        
        $data_tra= DB::table('nidcconfigs')->get();
        $tin = str_replace("-", "", $data_tra[0]->tin_num);
        $vfd = $data_tra[0]->vfd;
        $path = $data_tra[0]->cert_path;
        $password = $data_tra[0]->cert_password;
        $cert_serial = base64_encode($data_tra[0]->cert_serial);
        $payload = '<REGDATA><TIN>' . $tin . '</TIN><CERTKEY>' . $vfd . '</CERTKEY></REGDATA>';
        $priv_key = $this->get_key_from_file("./$path.pem", true, true, $password);
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
        $url = "https://virtual.tra.go.tz/efdmsRctApi/api/vfdRegReq";
        // $url = "https://vfd.tra.go.tz/api/vfdRegReq";  LIVE
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
        //dd($response);
        return $response;
    }

        //get key from file
        public function get_key_from_file($certficatePath, $isPrivateKey, $protected, $password)
        {
            //echo 'get_key_from_file-'.$certficatePath.'<br>';
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

    

}
