<?php

namespace App\Http\Controllers\Admin\Serviceinvoice;

use App\Http\Requests;
use App\Http\Requests\Serviceinvoice\CreateServiceInvoiceRequest;
use App\Http\Requests\Serviceinvoice\UpdateServiceInvoiceRequest;
use App\Repositories\Serviceinvoice\ServiceInvoiceRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Serviceinvoice\ServiceInvoice;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use DB;

class ServiceInvoiceController extends InfyOmBaseController
{
    /** @var  ServiceInvoiceRepository */
    private $serviceInvoiceRepository;

    public function __construct(ServiceInvoiceRepository $serviceInvoiceRepo)
    {
        $this->serviceInvoiceRepository = $serviceInvoiceRepo;
    }

    /**
     * Display a listing of the ServiceInvoice.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->serviceInvoiceRepository->pushCriteria(new RequestCriteria($request));
        $serviceInvoices = $this->serviceInvoiceRepository->all();
        return view('admin.serviceInvoice.serviceInvoices.index')
            ->with('serviceInvoices', $serviceInvoices);
    }

    /**
     * Show the form for creating a new ServiceInvoice.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.serviceInvoice.serviceInvoices.create');
    }

    /**
     * Store a newly created ServiceInvoice in storage.
     *
     * @param CreateServiceInvoiceRequest $request
     *
     * @return Response
     */
    public function store(CreateServiceInvoiceRequest $request)
    {
        $input = $request->all();

        $serviceInvoice = $this->serviceInvoiceRepository->create($input);

        Flash::success('ServiceInvoice saved successfully.');

        return redirect(route('admin.serviceInvoice.serviceInvoices.index'));
    }

    /**
     * Display the specified ServiceInvoice.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $serviceInvoice = $this->serviceInvoiceRepository->findWithoutFail($id);
        //dd($serviceInvoice);
        
        $customer_details = DB::table('customers')->where('id', $serviceInvoice->customer_no)->first();
        $postal_address = $customer_details->postal_address;
        $mobile_number = $customer_details->office_telephone;
        $district = $customer_details->district;
        $region = $customer_details->region;
        $country = $customer_details->country;
        $t_i_n_number = $customer_details->t_i_n_number;
        $v_a_t_registration_number = $customer_details->v_a_t_registration_number;
        $previous_dept = DB::table('paymentanddues')->where('customer_no', $serviceInvoice->customer_no)->first();
        $previous_dept = $previous_dept->total_amount;
        $previous_paid = DB::table('paymentanddues')->where('customer_no', $serviceInvoice->customer_no)->first()->paid_amount;
        if($previous_dept === $serviceInvoice->grand_total){
            
            $previous_dept ='0';
        }
        else{
            $grand_total = $serviceInvoice->grand_total;
            $previous_dept = $previous_dept- $grand_total; 
        }
        $service_name = (array)json_decode($serviceInvoice['service_name'], true);
        //$service_name=implode(",",$service_name);
        //$service_name = $serviceInvoice->service_name;
        $service_name_description = DB::table('products')->whereIn('product_name', $service_name)->get();
        //dd($service_name_description);

        // tax amount
        $tax_amount_total = DB::table('products')->whereIn('product_name',  $service_name)
                                            ->sum('vat_amount');

        // ED AMOUNT
        $ed_amount_total = DB::table('products')->whereIn('product_name', $service_name)
                                        ->sum('ed_amount');

        // SUB TOTAL
        $sub_total = DB::table('products')->whereIn('product_name', $service_name)
                                        ->sum('price');


        // DISCOUNT
        $discount =$serviceInvoice->discount;

        // GRAND TOTAL
        $grand_total = DB::table('products')->whereIn('product_name', $service_name)
                  ->sum('grand_total');
        $grand_total = $grand_total - $discount;

        // TOTAL PREVIOUS AND CURRENT BILL
        $Prev_current_total = $grand_total + $previous_dept;

        //   QR CODE LINK
        $qrcode = DB::table('serviceinvoices')->where('invoice_number', $serviceInvoice->invoice_number)
                  ->get();
        $qrcode_path = $qrcode[0]->qrcode_path;
        $RCTVNUM_DATE = $qrcode[0]->RCTVNUM_DATE;
        $RCTVNUM = $qrcode[0]->RCTVNUM;
        


        $serviceInvoice = array(
            "id" => $serviceInvoice->id,
            "invoice_number" => $serviceInvoice->invoice_number,
            "customer_no" => $serviceInvoice->customer_no,
            "invoice_created_date" => $serviceInvoice->invoice_created_date,
            "next_invoice_date" => $serviceInvoice->next_invoice_date,
            "invoice_due_date" => $serviceInvoice->invoice_due_date,
            "cusromer_name" => $serviceInvoice->cusromer_name,
            "service_order_no" => $serviceInvoice->service_order_no,
            "sub_total" => $sub_total,
            "qrcode_path" => $qrcode_path,
            "RCTVNUM" => $RCTVNUM,
            "RCTVNUM_DATE" => $RCTVNUM_DATE,
            "tax_amount_total" => $tax_amount_total,
            "ed_amount_total" => $ed_amount_total,
            "discount" => $serviceInvoice->discount,
            "grand_total" => $grand_total,
            "due_balance" => $serviceInvoice->due_balance,
            "current_charges" => $serviceInvoice->current_charges,
            "payment_amount" => $serviceInvoice->payment_amount,
            "payment_status" => $serviceInvoice->payment_status,
            "service_name" => $service_name,
            "service_name_description" => $service_name_description,
            "created_at" => $serviceInvoice->created_at,
            "updated_at" => $serviceInvoice->updated_at,
            "deleted_at" => $serviceInvoice->deleted_at,
            "postal_address" => $postal_address,
            "previous_dept" => $previous_dept,
            "previous_paid" => $previous_paid,
            "Prev_current_total" => $Prev_current_total,
            "district" => $district,
            "mobile_number" => $mobile_number,
            "serviceordertypes" => $serviceInvoice->serviceordertypes,
            "region" => $region,
            "country" => $country,
            "t_i_n_number" => $t_i_n_number,
            "v_a_t_registration_number" => $v_a_t_registration_number,
        );
        //dd($serviceInvoice);

        if (empty($serviceInvoice)) {
            Flash::error('ServiceInvoice not found');

            return redirect(route('serviceInvoices.index'));
        }

        return view('admin.serviceInvoice.serviceInvoices.show')->with('serviceInvoice', $serviceInvoice);
    }

    /**
     * Show the form for editing the specified ServiceInvoice.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $serviceInvoice = $this->serviceInvoiceRepository->findWithoutFail($id);

        if (empty($serviceInvoice)) {
            Flash::error('ServiceInvoice not found');

            return redirect(route('serviceInvoices.index'));
        }

        return view('admin.serviceInvoice.serviceInvoices.edit')->with('serviceInvoice', $serviceInvoice);
    }

    /**
     * Update the specified ServiceInvoice in storage.
     *
     * @param  int              $id
     * @param UpdateServiceInvoiceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateServiceInvoiceRequest $request)
    {
        $serviceInvoice = $this->serviceInvoiceRepository->findWithoutFail($id);

        

        if (empty($serviceInvoice)) {
            Flash::error('ServiceInvoice not found');

            return redirect(route('serviceInvoices.index'));
        }

        $serviceInvoice = $this->serviceInvoiceRepository->update($request->all(), $id);

        Flash::success('ServiceInvoice updated successfully.');

        return redirect(route('admin.serviceInvoice.serviceInvoices.index'));
    }

    /**
     * Remove the specified ServiceInvoice from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.serviceInvoice.serviceInvoices.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = ServiceInvoice::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.serviceInvoice.serviceInvoices.index'))->with('success', Lang::get('message.success.delete'));

       }


       
       public function processTraReceipt(Request $request)
       {
           //dd($request);

           
           $tra_details= DB::table('nidcconfigs')->get();
           $tin = str_replace("-", "", $tra_details[0]->tin_num);
           $TRA = $tra_details[0]->password . $this->get_count_gc($tra_details[0]->tin_num);
           $tokenAuth = $this->get_auth_token($tra_details[0]->username, $tra_details[0]->password);
   
           $this->send_efdrec_request_tra($tra_details, $tokenAuth['token_type'], $tokenAuth['access_token'], $request->cusromer_name, $request->mobile_number, $request->grand_total, $request);
           


           
        $serviceInvoice = $this->serviceInvoiceRepository->findWithoutFail($request->id);
        //dd($serviceInvoice);
        
        $customer_details = DB::table('customers')->where('id', $serviceInvoice->customer_no)->first();
        $postal_address = $customer_details->postal_address;
        $mobile_number = $customer_details->office_telephone;
        $district = $customer_details->district;
        $region = $customer_details->region;
        $country = $customer_details->country;
        $t_i_n_number = $customer_details->t_i_n_number;
        $v_a_t_registration_number = $customer_details->v_a_t_registration_number;
        $previous_dept = DB::table('paymentanddues')->where('customer_no', $serviceInvoice->customer_no)->first();
        $previous_dept = $previous_dept->total_amount;
        $previous_paid = DB::table('paymentanddues')->where('customer_no', $serviceInvoice->customer_no)->first()->paid_amount;
        if($previous_dept === $serviceInvoice->grand_total){
            
            $previous_dept ='0';
        }
        else{
            $grand_total = $serviceInvoice->grand_total;
            $previous_dept = $previous_dept- $grand_total; 
        }
        $service_name = (array)json_decode($serviceInvoice['service_name'], true);
        //$service_name=implode(",",$service_name);
        //$service_name = $serviceInvoice->service_name;
        $service_name_description = DB::table('products')->whereIn('product_name', $service_name)->get();
        //dd($service_name_description);

        // tax amount
        $tax_amount_total = DB::table('products')->whereIn('product_name',  $service_name)
                                            ->sum('vat_amount');

        // ED AMOUNT
        $ed_amount_total = DB::table('products')->whereIn('product_name', $service_name)
                                        ->sum('ed_amount');

        // SUB TOTAL
        $sub_total = DB::table('products')->whereIn('product_name', $service_name)
                                        ->sum('price');


        // DISCOUNT
        $discount =$serviceInvoice->discount;

        // GRAND TOTAL
        $grand_total = DB::table('products')->whereIn('product_name', $service_name)
                  ->sum('grand_total');
        $grand_total = $grand_total - $discount;

        // TOTAL PREVIOUS AND CURRENT BILL
        $Prev_current_total = $grand_total + $previous_dept;

        //   QR CODE LINK
        $qrcode = DB::table('serviceinvoices')->where('invoice_number', $serviceInvoice->invoice_number)
                  ->get();
        $qrcode_path = $qrcode[0]->qrcode_path;
        $RCTVNUM_DATE = $qrcode[0]->RCTVNUM_DATE;
        $RCTVNUM = $qrcode[0]->RCTVNUM;
        


        $serviceInvoice = array(
            "id" => $serviceInvoice->id,
            "invoice_number" => $serviceInvoice->invoice_number,
            "customer_no" => $serviceInvoice->customer_no,
            "invoice_created_date" => $serviceInvoice->invoice_created_date,
            "next_invoice_date" => $serviceInvoice->next_invoice_date,
            "invoice_due_date" => $serviceInvoice->invoice_due_date,
            "cusromer_name" => $serviceInvoice->cusromer_name,
            "service_order_no" => $serviceInvoice->service_order_no,
            "sub_total" => $sub_total,
            "qrcode_path" => $qrcode_path,
            "RCTVNUM" => $RCTVNUM,
            "RCTVNUM_DATE" => $RCTVNUM_DATE,
            "tax_amount_total" => $tax_amount_total,
            "ed_amount_total" => $ed_amount_total,
            "discount" => $serviceInvoice->discount,
            "grand_total" => $grand_total,
            "due_balance" => $serviceInvoice->due_balance,
            "current_charges" => $serviceInvoice->current_charges,
            "payment_amount" => $serviceInvoice->payment_amount,
            "payment_status" => $serviceInvoice->payment_status,
            "service_name" => $service_name,
            "service_name_description" => $service_name_description,
            "created_at" => $serviceInvoice->created_at,
            "updated_at" => $serviceInvoice->updated_at,
            "deleted_at" => $serviceInvoice->deleted_at,
            "postal_address" => $postal_address,
            "previous_dept" => $previous_dept,
            "previous_paid" => $previous_paid,
            "Prev_current_total" => $Prev_current_total,
            "district" => $district,
            "mobile_number" => $mobile_number,
            "serviceordertypes" => $serviceInvoice->serviceordertypes,
            "region" => $region,
            "country" => $country,
            "t_i_n_number" => $t_i_n_number,
            "v_a_t_registration_number" => $v_a_t_registration_number,
        );
        //dd($serviceInvoice);

           return view('admin.serviceInvoice.serviceInvoices.show')->with('serviceInvoice', $serviceInvoice);
       }

       
    public function send_efdrec_request_tra($reg_data, $token_type, $access_token, $name, $mobile,  $amount, $request)
    {
        $response = false;
        $xmlReq = $this->get_receipt_posted_data($reg_data, $name, $mobile, $amount, $request);
        $routing_key = $reg_data[0]->routekey;
        $access_token = trim($access_token);
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
        //$url = "https://vfd.tra.go.tz/api/efdmsRctInfo"; LIVE
        //3.Send the Request to the API
        //dd($xmlReq);
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
        //dd($xmlReq);
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
        $gc = $this->verification_receipts_barcode($request);

        //dd($response);
        return $response;
    }


    public function verification_receipts_barcode($request)
    {
        $RCTVNUM = DB::table('serviceinvoices')->where('invoice_number', $request->invoice_number)->first()->RCTVNUM;

        //1. Prepare the connectivity parameters.
        $url = "https://virtual.tra.go.tz/efdmsRctVerify"."/".$RCTVNUM;
        //$url = "https://vfd.tra.go.tz/api/efdmsRctInfo"; LIVE
        //3.Send the Request to the API
        $file = storage_path('QR-'.$RCTVNUM.'.png');
        $qrcode_path = 'QR-'.$RCTVNUM.'.png';
        $qrcode = \QRCode::text($url)->setOutfile($file)->png(); 
        $qrcode_path = DB::table('serviceinvoices')
                       ->where('invoice_number', $request->invoice_number)
                       ->update(['qrcode_path'=>$qrcode_path]);
        return null;

    }

    
    public function get_receipt_posted_data($reg_data, $name, $mobile, $amount, $request)
    {
        //dd($request);
        $tin = str_replace("-", "", $reg_data[0]->tin_num);
        $gc = $this->get_count($reg_data[0], 'gc');
        $dc = $this->get_count($reg_data[0], 'dc');
        $rctvnum = $reg_data[0]->recptcode . $gc;
        $payload = '<RCT><DATE>' . date('Y-m-d') . '</DATE><TIME>' . date('H:i:s') . '</TIME><TIN>' . $tin . '</TIN><REGID>' . $reg_data[0]->regid . '</REGID><EFDSERIAL>' . $reg_data[0]->vfd . '</EFDSERIAL><CUSTIDTYPE>1</CUSTIDTYPE><CUSTID>'.$request->t_i_n_number.'</CUSTID><CUSTNAME>' . $name . '</CUSTNAME><MOBILENUM>' . $mobile . '</MOBILENUM><RCTNUM>' . $gc . '</RCTNUM><DC>' . $dc . '</DC><GC>' . $gc . '</GC><ZNUM>' . date('Ymd') . '</ZNUM><RCTVNUM>' . $rctvnum . '</RCTVNUM><ITEMS><ITEM><ID>1</ID><DESC>'.$request->description.'</DESC><QTY>1</QTY><TAXCODE>1</TAXCODE><AMT>'.$request->price.'</AMT></ITEM></ITEMS><TOTALS><TOTALTAXEXCL>'.$request->price.'</TOTALTAXEXCL><TOTALTAXINCL>' . $amount . '</TOTALTAXINCL><DISCOUNT>0.00</DISCOUNT></TOTALS><PAYMENTS><PMTTYPE>INVOICE</PMTTYPE><PMTAMOUNT>' . $amount . '</PMTAMOUNT></PAYMENTS><VATTOTALS><VATRATE>A</VATRATE><NETTAMOUNT>' . $amount . '</NETTAMOUNT><TAXAMOUNT>'.$request->vat_amount.'</TAXAMOUNT></VATTOTALS></RCT>';
        $priv_key = $this->get_key_from_file("./" . $reg_data[0]->cert_path . ".pem", true, true, $reg_data[0]->cert_password);
        $signedPayload = $this->sign_payload_plain($payload, $priv_key);
        $update_invoice_rctvum_date = DB::table('serviceinvoices')
                                          ->where('invoice_number', $request->invoice_number)
                                          ->update(['RCTVNUM'=> $rctvnum , 'RCTVNUM_DATE'=>date('H:i:s')]);
        //dd($priv_key);
        $recXML = "<EFDMS>
					$payload
					<EFDMSSIGNATURE>
					$signedPayload
					</EFDMSSIGNATURE>
				</EFDMS>";
        //dd($recXML);
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
