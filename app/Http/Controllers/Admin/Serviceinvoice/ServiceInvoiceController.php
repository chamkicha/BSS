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
use Carbon\Carbon;
use Mail;
use DB;
use Illuminate\Support\Str;

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
        if(count($serviceInvoices)=='0')
        {
            return view('admin.serviceInvoice.serviceInvoices.index')
            ->with('serviceInvoices', $serviceInvoices);
        }else{

        $client_product = DB::table('clientproducts')->where('service_order_no',$serviceInvoices[0]->service_order_no)->get();
        return view('admin.serviceInvoice.serviceInvoices.index')
            ->with('client_product', $client_product)
            ->with('serviceInvoices', $serviceInvoices);
        }
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
        //dd($customer_details);
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
        $service_name_description =DB::table('clientproducts')->where('service_order_no', $serviceInvoice->service_order_no)->get();

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
        $Prev_current_total = $serviceInvoice->grand_total + $previous_dept;

        //   QR CODE LINK
        $qrcode = DB::table('serviceinvoices')->where('invoice_number', $serviceInvoice->invoice_number)
                  ->get();
        $qrcode_path = $qrcode[0]->qrcode_path;
        $RCTVNUM_DATE = $qrcode[0]->RCTVNUM_DATE;
        $RCTVNUM = $qrcode[0]->RCTVNUM;
        


        $serviceInvoice = array(
            "id" => $serviceInvoice->id,
            "invoice_number" => $serviceInvoice->invoice_number,
            "customer_no" => $serviceInvoice->customer_name,
            "invoice_created_date" => Carbon::parse($serviceInvoice->invoice_created_date)->format('d-m-Y'),
            "next_invoice_date" => Carbon::parse($serviceInvoice->next_invoice_date)->format('d-m-Y'),
            "invoice_due_date" => Carbon::parse($serviceInvoice->invoice_due_date)->format('d-m-Y'),
            "cusromer_name" => $customer_details->customername,
            "service_order_no" => $serviceInvoice->service_order_no,
            "sub_total" => $serviceInvoice->sub_total,
            "qrcode_path" => $qrcode_path,
            "RCTVNUM" => $RCTVNUM,
            "RCTVNUM_DATE" => $RCTVNUM_DATE,
            "tax_amount_total" => $serviceInvoice->tax_amount,
            "ed_amount_total" => $ed_amount_total,
            "discount" => $serviceInvoice->discount,
            "grand_total" => $serviceInvoice->grand_total,
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
        //dd($service_name_description);

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
        //dd($customer_details->customername);
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
        
        $service_name_description =DB::table('clientproducts')->where('service_order_no', $serviceInvoice->service_order_no)->get();
        

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
        $Prev_current_total = $serviceInvoice->grand_total + $previous_dept;

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
            "invoice_created_date" => Carbon::parse($serviceInvoice->invoice_created_date)->format('d-m-Y'),
            "next_invoice_date" => Carbon::parse($serviceInvoice->next_invoice_date)->format('d-m-Y'),
            "invoice_due_date" => Carbon::parse($serviceInvoice->invoice_due_date)->format('d-m-Y'),
            "cusromer_name" => $customer_details->customername,
            "service_order_no" => $serviceInvoice->service_order_no,
            "sub_total" => $serviceInvoice->sub_total,
            "qrcode_path" => $qrcode_path,
            "RCTVNUM" => $RCTVNUM,
            "RCTVNUM_DATE" => $RCTVNUM_DATE,
            "tax_amount_total" => $serviceInvoice->tax_amount,
            "ed_amount_total" => $ed_amount_total,
            "discount" => $serviceInvoice->discount,
            "grand_total" => $serviceInvoice->grand_total,
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
        //dd($service_name_description);

        if (empty($serviceInvoice)) {
            Flash::error('ServiceInvoice not found');

            return redirect(route('serviceInvoices.index'));
        }

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
            activity('HEADER '.$name)->log(json_encode($headers));

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
            $xml = simplexml_load_string($response);
            $response_msg = $xml->RCTACK->ACKCODE;
            $responce_code = json_decode($response_msg);
            //dd(json_decode($response_msg));
            if(json_decode($response_msg) == 0){

                $subjects = 'SUCCESS to get signature for '.$name. ' from '.Carbon::now()->format('d-m-Y');
                $content = $responce_code.' payload successful sent to TRA';

                Mail::raw($content, function ($message)use ($subjects) {
                    $message->from('nidctanzania@gmail.com', 'NIDC-BSS');
                    $message->to('jchamkicha@gmail.com')
                             ->subject($subjects)
                            ->cc('nidctanzania@gmail.com');
                });
                //activity log
                 activity('SUCCESS_SENT_TRA ')->log($responce_code);
                 // update status
                 $gc = $this->verification_receipts_barcode($request,'success',$responce_code);

            }else{
                $subjects = 'FAILED to get signature for '.$name. ' from '.Carbon::now()->format('d-m-Y');
                $content = $responce_code.' payload not successful sent to TRA';

                Mail::raw($content, function ($message)use ($subjects) {
                    $message->from('nidctanzania@gmail.com', 'NIDC-BSS');
                    $message->to('jchamkicha@gmail.com')
                             ->subject($subjects)
                            ->cc('nidctanzania@gmail.com');
                });
                //activity log
                 activity('FAILED_SENT_TRA ')->log($responce_code);
                 // update status
                 $gc = $this->verification_receipts_barcode($request,'failed',$responce_code);
 

                //dd('failed');


            }

        } else {
            $response = false;
        }

        //dd($response);
        return $response;
    }


    public function verification_receipts_barcode($request, $status,$responce_code)
    {
        $RCTVNUM = DB::table('serviceinvoices')->where('invoice_number', $request->invoice_number)->get();
       $RCTVNUM_DATE = $RCTVNUM[0]->RCTVNUM_DATE;
        $RCTVNUM_DATE = str_replace(":", "", $RCTVNUM_DATE);
        //1. Prepare the connectivity parameters.
        $url = "https://virtual.tra.go.tz/efdmsRctVerify"."/".$RCTVNUM[0]->RCTVNUM."_".$RCTVNUM_DATE;
        //$url = "https://vfd.tra.go.tz/api/efdmsRctInfo"; LIVE
        //3.Send the Request to the API
        $file = public_path('qrimages/'.'QR-'.$RCTVNUM[0]->RCTVNUM.'.png');
        $qrcode_path = 'QR-'.$RCTVNUM[0]->RCTVNUM.'.png';
        $qrcode = \QRCode::text($url)->setOutfile($file)->png(); 
        $qrcode_path = DB::table('serviceinvoices')
                       ->where('invoice_number', $request->invoice_number)
                       ->update(['qrcode_path'=>$qrcode_path,
                                 'RCTVNUM_STATUS'=>$status,
                                 'responce_code'=>$responce_code,
                                 'get_signature_by'=>$request->get_signature_by]);
        return null;

    }

    
    public function get_receipt_posted_data($reg_data, $name, $mobile, $amount, $request)
    {
        $customer_tin = str_replace("-", "", $request->t_i_n_number);
        if($customer_tin == "")
        {
            $customer_tin = $customer_tin;
            $customer_id_type = 6;

        }
        else{
            $customer_tin = $customer_tin;
            $customer_id_type = 1;

        }
        $service_name_description =DB::table('clientproducts')->where('service_order_no', $request->service_order_no)->get();
        $items = "<ITEMS>";
        $ID = 1;
        $TAXCODE = 1;
        foreach($service_name_description as $item){
            $items .= "<ITEM><ID>".$ID++."</ID><DESC>".$item->product_description."</DESC><QTY>".$item->product_quantity."</QTY><TAXCODE>".$TAXCODE."</TAXCODE><AMT>". round($item->amount, 2) ."</AMT></ITEM>";
        }
        $items.="</ITEMS>";
        //dd($items);
        $tin = str_replace("-", "", $reg_data[0]->tin_num);
        $gc = $this->get_count($reg_data[0], 'gc');
        $dc = $this->get_count($reg_data[0], 'dc');
        $rctvnum = $reg_data[0]->recptcode . $gc;
        $name = str_replace("'", "", $name);
        $name = str_replace(",", "", $name);
        $name = str_replace("&", "", $name);
        $name = Str::substr($name, 0, 99);
        $payload = '<RCT><DATE>' . date('Y-m-d') . '</DATE><TIME>' . date('H:i:s') . '</TIME><TIN>' . $tin . '</TIN><REGID>' . $reg_data[0]->regid . '</REGID><EFDSERIAL>' . $reg_data[0]->vfd . '</EFDSERIAL><CUSTIDTYPE>'.$customer_id_type.'</CUSTIDTYPE><CUSTID>'.$customer_tin.'</CUSTID><CUSTNAME>' . $name . '</CUSTNAME><MOBILENUM>' . (int)$mobile . '</MOBILENUM><RCTNUM>' . $gc . '</RCTNUM><DC>' . $dc . '</DC><GC>' . $gc . '</GC><ZNUM>' . date('Ymd') . '</ZNUM><RCTVNUM>' . $rctvnum . '</RCTVNUM>'. $items .'<TOTALS><TOTALTAXEXCL>'. round($request->sub_total, 2) .'</TOTALTAXEXCL><TOTALTAXINCL>' . round($request->grand_total, 2) . '</TOTALTAXINCL><DISCOUNT>0.00</DISCOUNT></TOTALS><PAYMENTS><PMTTYPE>INVOICE</PMTTYPE><PMTAMOUNT>' . round($request->grand_total, 2) . '</PMTAMOUNT></PAYMENTS><VATTOTALS><VATRATE>A</VATRATE><NETTAMOUNT>' . round($request->sub_total, 2) . '</NETTAMOUNT><TAXAMOUNT>'. round($request->tax_amount_total, 2) .'</TAXAMOUNT></VATTOTALS></RCT>';
        $priv_key = $this->get_key_from_file("./" . $reg_data[0]->cert_path . ".pem", true, true, $reg_data[0]->cert_password);
        $signedPayload = $this->sign_payload_plain($payload, $priv_key);
        $update_invoice_rctvum_date = DB::table('serviceinvoices')
                                          ->where('invoice_number', $request->invoice_number)
                                          ->update(['RCTVNUM'=> $rctvnum , 
                                                     'tra_dc'=> $dc , 
                                                     'tra_gc'=> $gc , 
                                                     'RCTVNUM_DATE'=>date('H:i:s')]);
        //dd($signedPayload);
        
        activity('payload '. $name)->log($payload);

        $recXML = "<EFDMS>
					$payload
					<EFDMSSIGNATURE>
					$signedPayload
					</EFDMSSIGNATURE>
				</EFDMS>";
        activity('recXML '. $name)->log($recXML);
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
        dd($reg_resp);
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





    public function auto_invoice_generator(){
        $today =  date('Y-m-d');
        $invoice_details_load = DB::table('serviceinvoices')->where('next_invoice_date',$today)->get();
       
        //dd($invoice_details_load);
        foreach($invoice_details_load as $invoice_details)
        {
             // check contract validation
            $service_validation = DB::table('serviceorderss')
                                 ->where('order_i_d', $invoice_details->service_order_no)
                                 ->first();
            $service_status = $service_validation->service_status;

            //dd($invoice_details_load);
            // check invoice deletion
           $service_deletion = DB::table('serviceinvoices')
                                ->where('invoice_number', $invoice_details->invoice_number)
                                ->first()->deleted_at;

            if($service_status == 'Active' && is_null($service_deletion)){

                // Payment and Due creation
                //dd('sisi');
                $customer_no = $invoice_details->customer_no;

                $payment_due = DB::table('paymentanddues')->where('customer_no', $customer_no)->first();

                if(is_null($payment_due)){

                // PAYMENT AND DUE insert into database
                $grand_total_due =$invoice_details->grand_total;
                $bill_creation = DB::table('paymentanddues')
                ->insert(['customer_name' => $customer_name,
                        'total_amount' => $grand_total_due,
                        'balance' => $grand_total_due,
                        'customer_no' => $customer_no,]);


                }else{
                    
                    // PAYMENT AND DUE update into database
                    $grand_total3 = DB::table('paymentanddues')->where('customer_no', $customer_no)->get();
                    $grand_total2 = $grand_total3[0]->total_amount;
                    $grand_total1 = $invoice_details->grand_total;
                    $grand_total4 = $grand_total1 + $grand_total2;
                    $balance = $grand_total3[0]->balance;
                    $balance = $balance + $grand_total1;
                    //dd($grand_total4);
                    
                    $bill_creation = DB::table('paymentanddues')
                    ->where('customer_no', $customer_no)
                    ->update(['total_amount' => $grand_total4,
                            'balance' => $balance]);
                } // END PAYMEND AND DUE CREATIONM

                

                // INVOICE creation
                $invoice_number = DB::table('serviceinvoices')->orderBy('invoice_number', 'desc')->first();
                if(is_null($invoice_number)){
            $invoice_number = 1000;
                }else{
                    $invoice_number = $invoice_number->invoice_number + 1;
                }
                $activation_date = date('Y-m-d');
                
                // next_invoice_date creation
                $payment_mode_intervals = $invoice_details->payment_mode;
                $next_invoice_date = Carbon::parse($activation_date)->addDays($payment_mode_intervals)->format('Y-m-d');
                // next_invoice_date creation
                $invoice_due_date = Carbon::parse($next_invoice_date)->addDays(4)->format('Y-m-d');
                
                $cusromer_name = $invoice_details->cusromer_name;
                $customer_no = $invoice_details->customer_no;
                $service_order_no =$invoice_details->service_order_no;
                $due_balance = DB::table('paymentanddues')->where('customer_no', $customer_no)->first();
                $due_balance = $due_balance->total_amount;
                $current_charges =$invoice_details->grand_total;
                $payment_amount =$invoice_details->grand_total;
                $payment_status =DB::table('paymenttypes')->where('id', '2')->get();
                $payment_status = $payment_status[0]->payment_type_name;
                $service_name = $invoice_details->service_name;
                $sub_total = $invoice_details->sub_total;
                $tax_amount = $invoice_details->tax_amount;
                $ed_amount = $invoice_details->ed_amount;
                $discount = $invoice_details->discount;
                $grand_total = $invoice_details->grand_total;

                // CUSTOMER REVENUE REPORT GENERATION POSTPAID
                $invoice_details = array(
                'invoice_number' => $invoice_number,
                'cusromer_name' => $cusromer_name, 
                'customer_no' => $customer_no, 
                'current_charges' => $current_charges, 
                'service_order_no' => $service_order_no,
                'invoice_created_date' => $activation_date,
                'due_balance' => $due_balance,
                'service_name' => $service_name,
                'payment_amount' => $payment_amount,
                'payment_status' => $payment_status,
                'sub_total' => $sub_total,
                'tax_amount' => $tax_amount,
                'ed_amount' => $ed_amount,
                'discount' => $discount,
                'grand_total' => $grand_total
                );
                $customer_report_run = $this->customer_report_revenue($invoice_details);

                // INVOICE insert into database
                $invoice_creation = DB::table('serviceinvoices')
                ->insert(['invoice_number' => $invoice_number,
                        'cusromer_name' => $cusromer_name, 
                        'customer_no' => $customer_no, 
                        'current_charges' => $current_charges, 
                        'service_order_no' => $service_order_no,
                        'invoice_created_date' => $activation_date,
                        'next_invoice_date' => $next_invoice_date,
                        'invoice_due_date' => $invoice_due_date,
                        'due_balance' => $due_balance,
                        'service_name' => $service_name,
                        'payment_amount' => $payment_amount,
                        'payment_status' => $payment_status,
                        'sub_total' => $sub_total,
                        'tax_amount' => $tax_amount,
                        'ed_amount' => $ed_amount,
                        'discount' => $discount,
                        'grand_total' => $grand_total]);

                        $subjects = 'Invoice '.$invoice_number. ' generated for '.$cusromer_name.' from '.Carbon::parse($activation_date)->format('d-m-Y').' to '.Carbon::parse($next_invoice_date)->format('d-m-Y');
                        $content = 'Please login to BSS (10.60.83.218) to check the Invoice generated';

                        Mail::raw($content, function ($message)use ($subjects) {
                            $message->from('nidctanzania@gmail.com', 'NIDC-BSS');
                            $message->to('jchamkicha@gmail.com')
                                     ->subject($subjects)
                                    ->cc('nidctanzania@gmail.com');
                        });

                    }



        }
    }

    // CUSTOMER REVENUE REPORT CLASS
    public function customer_report_revenue($clientreport)
    {

        $service_order_type = DB::table('revenuepercustomerreports')
                            ->where('customer_no', $clientreport['customer_no'])
                            ->first();

        $customer_type = DB::table('customers')
                            ->where('id', $clientreport['customer_no'])
                            ->first()
                            ->customer_type;

    $service_name = (array)json_decode($clientreport['service_name'], true);
        
        $excise_dutty = DB::table('products')
                            ->whereIn('product_name', $service_name)
                            ->sum('ed_amount');
        
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');

        if(is_null($service_order_type)){

        $service_order_type = DB::table('revenuepercustomerreports')
                                    ->insert([
                                        'customer_name' => $clientreport['cusromer_name'],
                                        'customer_no' => $clientreport['customer_no'],
                                        'customer_type' => $customer_type,
                                        'services' => $clientreport['service_name'],
                                        'excise_dutty' => (int)$excise_dutty,
                                        'v_a_t' => (int)$clientreport['tax_amount'],
                                        'total_wit_vat' => (int)$clientreport['grand_total'],
                                        'created_at' => $created_at
                                    ]);


        }else{
        //dd($clientreport);

            $service_order_type = DB::table('revenuepercustomerreports')
                            ->where('customer_no', $clientreport['customer_no'])
                            ->first();
            $excise_dutty = (int)$service_order_type->excise_dutty + (int)$excise_dutty;
            $tax_amount = (int)$service_order_type->v_a_t + (int)$clientreport['tax_amount'];
            $grand_total = (int)$service_order_type->total_wit_vat + (int)$clientreport['grand_total'];
            //$service_name = $service_order_type->services + $clientreport['service_name'];

            $service_order_type = DB::table('revenuepercustomerreports')
                            ->where('customer_no', $clientreport['customer_no'])
                            ->update([
                                //'services' => $service_name,
                                'excise_dutty' => $excise_dutty,
                                'v_a_t' => $tax_amount,
                                'total_wit_vat' => $grand_total,
                                'updated_at' => $updated_at,
                            ]);

        }
        //dd($clientreport);
        

    } // END CUSTOMER REVENUE REPORT CLASS




}
