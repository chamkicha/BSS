
<li class="dropdown notifications-menu">
    <a href="#dropdownshow" class="dropdown-toggle" data-toggle="dropdown">
        <i class="livicon" data-name="bell" data-loop="true" data-color="#e9573f"
           data-hovercolor="#e9573f" data-size="28"></i>
        <span class="label bg-warning">{{serviceorders()}}</span>
    </a>
    <ul class=" notifications dropdown-menu drop_notify" >
        <li class="dropdown-title">You have {{serviceorders()}} Pending task</li>
        {{--  <li>
            <!-- inner menu: contains the actual data -->
            <ul class=" menu remove_hovereffect">
            
            @foreach (serviceorders() as $value)
                <li class="dropdown-item">
                    <i class="livicon danger" data-n="timer" data-s="20" data-c="white"
                       data-hc="white"></i>
                    <a href="#">{{$value ->customer_name}}</a>
                    <small class="float-right">
                        <span class="livicon p-2" data-n="timer" data-s="10"></span>
                        Just Now
                    </small>
                </li>
                @endforeach
            </ul>
        </li>  --}}
        <li class="footer">
            <a href="{!! route('admin.serviceOrders.serviceOrders.index') !!}">View all</a>
        </li>
    </ul>
</li>





<?php
use App\Models\Servicestatus\Servicestatus;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

    function serviceorders()
    {      
        $user1= Sentinel::getUser()->first_name;
        $user2= " ";
        $user3= Sentinel::getUser()->last_name;
        $user= $user1.$user2.$user3;
        //dd($user);
        $serviceorder = DB::table('serviceorderss')->where('next_handler', $user)->count();
        return $serviceorder;
    } 



?>