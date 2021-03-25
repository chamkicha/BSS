


<?php $__env->startSection('header_styles'); ?>

<link type="text/css" href="<?php echo e(asset('vendors/bootstrap-multiselect/css/bootstrap-multiselect.css')); ?>"
      rel="stylesheet"/>
<link href="<?php echo e(asset('vendors/select2/css/select2.min.css')); ?>" rel="stylesheet"/>
<link href="<?php echo e(asset('vendors/select2/css/select2-bootstrap.css')); ?>" rel="stylesheet"/>
<link href="<?php echo e(asset('vendors/selectize/css/selectize.css')); ?>" rel="stylesheet"/>
<link href="<?php echo e(asset('vendors/selectize/css/selectize.bootstrap3.css')); ?>" rel="stylesheet"/>
<link href="<?php echo e(asset('vendors/iCheck/css/all.css')); ?>" rel="stylesheet"/>
<link href="<?php echo e(asset('vendors/iCheck/css/line/line.css')); ?>" rel="stylesheet"/>
<link href="<?php echo e(asset('vendors/bootstrap-switch/css/bootstrap-switch.css')); ?>" rel="stylesheet"/>
<link href="<?php echo e(asset('vendors/switchery/css/switchery.css')); ?>" rel="stylesheet"/>
<link href="<?php echo e(asset('css/pages/formelements.css')); ?>" rel="stylesheet"/>
<?php $__env->stopSection(); ?>

<?php
use App\Models\Servicestatus\Servicestatus;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


function servicestatus()
{      
  $servicestatus = Servicestatus::where('id','2')->first();
return $servicestatus->service_status_name;
} 

function createdby()
{      
    
    $user = Sentinel::getUser()->first_name;
    $user2 = Sentinel::getUser()->last_name;
    $user3 =' ';
    $user =$user.$user3.$user2;
    return $user;
} 


function nexthandler()
{      
    
    $nexthandler = DB::table('role_users')->where('role_id','3')->get();
    $nexthandler = DB::table('users')->where('id',$nexthandler[0]->user_id)->get();
    $nexthandler1 = $nexthandler[0]->first_name;
    $nexthandler2 = $nexthandler[0]->last_name;
    $nexthandler3 = ' ';
    $nexthandler = $nexthandler1.$nexthandler3.$nexthandler2;
    return $nexthandler;
} 

function serviceorder()
{   

              
    $serviceorder = DB::table('serviceorderss')->orderBy('order_i_d', 'desc')->first();
    
    if(is_null($serviceorder)){

        $serviceorder1 = 'SO_';

        $ordernumber = date('Y-m-d ');
        $ordernumber = str_replace("-", "", $ordernumber);
        $ordernumber = str_replace(":", "", $ordernumber);
        $ordernumber2 = str_replace(" ", "", $ordernumber);
 
        $serviceorder3 = 1000;
        $serviceorder = $serviceorder1.$ordernumber2.$serviceorder3;

    }else{
        $serviceorder = DB::table('serviceorderss')->orderBy('order_i_d', 'desc')->first()->order_i_d;
        $serviceorder=substr($serviceorder, -4);
        $serviceorder3 = e($serviceorder) + 1;
        $serviceorder1 = 'SO_';

        $ordernumber = date('Y-m-d ');
        $ordernumber = str_replace("-", "", $ordernumber);
        $ordernumber = str_replace(":", "", $ordernumber);
        $ordernumber2 = str_replace(" ", "", $ordernumber);
        $serviceorder = $serviceorder1.$ordernumber2.$serviceorder3;
    }
        return $serviceorder;
} 

function serviceprice()
{      
    $serviceprice = 10000;
    return $serviceprice;
}

?>




<!-- Order I D Field -->
<div class="form-group col-sm-12">
    
    <input type="hidden" id="order_i_d"name="order_i_d" class="form-control" value = "<?php echo e(serviceorder()); ?>">
    
</div>

<!-- Customer Name Field -->
<div class="form-group col-sm-12">

    <label for="select21" class="control-label">
        Customer:
    </label>
    <select name="customer_name" id="select21" class="form-control select2">
            
            <option value="">Select Customer Name</option>
            <?php $__currentLoopData = $customer_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($customer->customername); ?>"><?php echo e($customer->customername); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </optgroup>
    </select>
</div>


<!-- Payment Mode Field -->
<div class="form-group col-sm-12">
    <label for="select21" class="control-label">
        Payment mode:
    </label>
    <select name="payment_mode" id="select21" class="form-control select2">
            
            <option value="">Select Payment Mode</option>
            <?php $__currentLoopData = $paymentmode_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paymentmode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($paymentmode->payment_mode_name); ?>"><?php echo e($paymentmode->payment_mode_name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </optgroup>
    </select>
</div>

<!-- Service Status Field -->
<div class="form-group col-sm-12">
    
        <input type="hidden" id="service_status"name="service_status" class="form-control" value = "<?php echo e(servicestatus()); ?>">
    
</div>

<!-- Price Field -->
<div class="form-group col-sm-12">
        
    <input type="hidden" id="price" name="price" class="form-control" value = "<?php echo e(serviceprice()); ?>">
    

</div>

<!-- Service Starting Date Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('service_starting_date', 'Service Starting Date:'); ?>

    <?php echo Form::date('service_starting_date', null, ['class' => 'form-control']); ?>

</div>

<!-- Service Ending Date Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('service_ending_date', 'Service Ending Date:'); ?>

    <?php echo Form::date('service_ending_date', null, ['class' => 'form-control']); ?>

</div>

<!-- Service Descriptions Field -->
<div class="form-group col-sm-12">
    <?php echo Form::label('service_descriptions', 'Service Descriptions:'); ?>

    <?php echo Form::text('service_descriptions', null, ['class' => 'form-control']); ?>

</div>

<!-- Service Lists Field -->
<div class="form-group col-sm-12">
    <?php $__currentLoopData = $product_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_lists): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <label class="checkbox-inline">
    <input type="checkbox" id="service_lists" name="service_lists[]" value="<?php echo e($product_lists->product_name); ?>"> <?php echo e($product_lists->product_name); ?>

    </label>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<!-- Next Handler Field -->
<div class="form-group col-sm-12">
           
    <input type="hidden" id="next_handler" name="next_handler" class="form-control" value = "<?php echo e(nexthandler()); ?>">
    
</div>

<!-- user Field -->
<div class="form-group col-sm-12"> 
        
    <input type="hidden" id="created_by" name="created_by" class="form-control" value = "<?php echo e(createdby()); ?>">
    
</div>


<div class="form-group row">
    <div class="col-sm-12">
      <label for="status">Change Status:</label>
        <select id="req_status" name="req_status">
          <option disabled selected value> -- select status -- </option>
          
          <?php if(Sentinel::inRole('commercial-manager') ): ?>
               <option value="verified">Verify</option>
                <option value="cancelled">Cancel</option>
          <?php elseif(Sentinel::inRole('user') && $request->next_handler==='finance'): ?>
              <option value="approved">Approve</option>
              <option value="cancelled">Cancel</option>
          <?php elseif(Sentinel::inRole('user') && $request->next_handler==='store'): ?>
              <option value="issued">Issue</option>
              <option value="cancelled">Cancel</option>
          <?php elseif(Sentinel::inRole('user') && $request->next_handler==='sales'): ?>
              <option value="delivered">Deliver</option>
              <option value="cancelled">Cancel</option>
          <?php elseif(Sentinel::inRole('admin')): ?>
              <option value="verified">Verify</option>
              <option value="approve">Approve</option>
              <option value="issued">Issue</option>
              <option value="delivered">Deliver</option>
              <option value="cancelled">Cancel</option>
          <?php endif; ?>
          </select>
</div>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    <?php echo Form::submit('Save', ['class' => 'btn btn-primary']); ?>

    <a href="<?php echo route('admin.serviceOrders.serviceOrders.index'); ?>" class="btn btn-secondary">Cancel</a>
</div>




<?php $__env->startSection('footer_scripts'); ?>
<script language="javascript" type="text/javascript"
        src="<?php echo e(asset('vendors/bootstrap-multiselect/js/bootstrap-multiselect.js')); ?>"></script>
<script language="javascript" type="text/javascript" src="<?php echo e(asset('vendors/select2/js/select2.js')); ?>"></script>
<script language="javascript" type="text/javascript" src="<?php echo e(asset('vendors/select2/js/select2.js')); ?>"></script>

<script language="javascript" type="text/javascript" src="<?php echo e(asset('vendors/sifter/sifter.js')); ?>"></script>
<script language="javascript" type="text/javascript"
        src="<?php echo e(asset('vendors/microplugin/microplugin.js')); ?>"></script>
<script language="javascript" type="text/javascript"
        src="<?php echo e(asset('vendors/selectize/js/selectize.min.js')); ?>"></script>
<script language="javascript" type="text/javascript" src="<?php echo e(asset('vendors/iCheck/js/icheck.js')); ?>"></script>
<script language="javascript" type="text/javascript"
        src="<?php echo e(asset('vendors/bootstrap-switch/js/bootstrap-switch.js')); ?>"></script>
<script language="javascript" type="text/javascript"
        src="<?php echo e(asset('vendors/switchery/js/switchery.js')); ?>"></script>
<script language="javascript" type="text/javascript"
        src="<?php echo e(asset('vendors/bootstrap-maxlength/js/bootstrap-maxlength.js')); ?>"></script>
<script language="javascript" type="text/javascript"
        src="<?php echo e(asset('vendors/card/js/jquery.card.js')); ?>"></script>
<script language="javascript" type="text/javascript" src="<?php echo e(asset('js/pages/custom_elements.js')); ?>"></script>

<?php $__env->stopSection(); ?><?php /**PATH C:\xampp\htdocs\BSS\resources\views/admin/serviceOrders/serviceOrders/fields.blade.php ENDPATH**/ ?>