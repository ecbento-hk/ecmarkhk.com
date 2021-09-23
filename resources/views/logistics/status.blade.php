@extends('logistics.layout')

@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="/js/qrcode.min.js"></script>
<style>
    .qrcode img {
        width: 100%;
        max-width: 100px;
    }

</style>


<div class="row">
    <div class="col-4">

    <div class="card mt-4" style="">
    <div class="card-body">
        <h5 class="card-title"><span class="badge badge-primary">{{strtoupper($machine->type)}}</span></h5>
        <p class="card-text"><small>{{$machine->imei}}</small></p>
        <p class="card-text"><small>{{$machine->code}}</small></p>
        <p class="card-text"><small>{{$machine->name}}</small></p>
        <p class="card-text"><small></small></p>
        <a href="{{route('logistics.machine',['store'=>$store->id ])  }}" class="card-link">Back</a>
    </div>
    </div>

    </div>

    <div class="col-8">
        
    <div class="card mt-4" style="max-width: 100%;">
    <div class="card-body">
        <h5 class="card-title"><span class="badge badge-primary">ALL CONTROL</span></h5>
        
        <!-- <p class="card-text">Status: Online</p>
      -->
     
        <a class="btn btn-sm btn-info mb-2"
        onclick="get(' {{route('logistics.action',['machine'=>$machine->id,'action'=>'DOOR_OPEN','cell'=>'all'])}} ')">
                {{ __('Door Open') }}
        </a>
        <br>
        <a class="btn btn-sm btn-info mb-2"
        onclick="get(' {{route('logistics.action',['machine'=>$machine->id,'action'=>'WARM_START','cell'=>'all'])}} ')">
                {{ __('Warm Start') }}
        </a>
        <a class="btn btn-sm btn-info mb-2"
        onclick="get(' {{route('logistics.action',['machine'=>$machine->id,'action'=>'WARM_STOP','cell'=>'all'])}} ')">
                {{ __('Warm Stop') }}
        </a>
<br>
        <a class="btn btn-sm btn-info mb-2"
        onclick="get(' {{route('logistics.action',['machine'=>$machine->id,'action'=>'DISINFECT_START','cell'=>'all'])}} ')">
            
                {{ __('Disinfect Start') }}
        </a>
        <a class="btn btn-sm btn-info mb-2"
        onclick="get(' {{route('logistics.action',['machine'=>$machine->id,'action'=>'DISINFECT_STOP','cell'=>'all'])}} ')">
            
                {{ __('Disinfect Stop') }}
        </a>
<br>
        <a class="btn btn-sm btn-info mb-2"
        onclick="get(' {{route('logistics.action',['machine'=>$machine->id,'action'=>'LIGHT_OPEN','cell'=>'all'])}} ')">
            
                {{ __('Light Start') }}
        </a>
        <a class="btn btn-sm btn-info mb-2"
        onclick="get(' {{route('logistics.action',['machine'=>$machine->id,'action'=>'LIGHT_CLOSE','cell'=>'all'])}} ')">
            
                {{ __('Light Stop') }}
        </a>
        <a class="btn btn-sm btn-info mb-2"
        onclick="get(' {{route('logistics.action',['machine'=>$machine->id,'action'=>'CANCEL_ALL_ORDER','cell'=>'all'])}} ')">
            
                {{ __('Cancel Order') }}
        </a>
    </div>
    </div>

    </div>
</div>



<table class="table-auto mt-4" style="width:100%">
    <thead>
        <tr>
            <td class="border px-4 py-2">Cell</td>
            <td class="border px-4 py-2">Action</td>
            <td class="d-none border px-4 py-2">Status</td>
            <td class="border px-4 py-2">Order</td>
        </tr>
    </thead>
    <tbody>


        @foreach($cells as $i =>$cell)
      
        <tr>

            <td class="border px-4 py-2">Cell #{{$cell['cellId']}}</td>
            <td class="border px-4 py-2">

                <a class="btn btn-sm btn-info mb-2"
                onclick="get(' {{route('logistics.action',['machine'=>$machine->id,'action'=>'DOOR_OPEN','cell'=>$cell['cellId']])}} ')">
                        {{ __('Door Open') }}
                </a>
                <br>
                
                <div class="inline-flex">
                    <a class="btn btn-sm btn-info mb-2"
                    onclick="get(' {{route('logistics.action',['machine'=>$machine->id,'action'=>'WARM_START','cell'=>$cell['cellId']])}} ')">
                            {{ __('Warm Start') }}
                    </a>
                    <a class="btn btn-sm btn-info mb-2"
                    onclick="get(' {{route('logistics.action',['machine'=>$machine->id,'action'=>'WARM_STOP','cell'=>$cell['cellId']])}} ')">
                       
                            {{ __('Warm Stop') }}
                    </a>

                </div>

                <div class="inline-flex">
                    <a class="btn btn-sm btn-info mb-2"
                    onclick="get(' {{route('logistics.action',['machine'=>$machine->id,'action'=>'DISINFECT_START','cell'=>$cell['cellId']])}} ')">
                        
                            {{ __('Disinfect Start') }}
                    </a>
                    <a class="btn btn-sm btn-info mb-2"
                    onclick="get(' {{route('logistics.action',['machine'=>$machine->id,'action'=>'DISINFECT_STOP','cell'=>$cell['cellId']])}} ')">
                      
                            {{ __('Disinfect Stop') }}
                    </a>

                </div>

                <div class="inline-flex">

                    <a class="btn btn-sm btn-info mb-2"
                    onclick="get(' {{route('logistics.action',['machine'=>$machine->id,'action'=>'LIGHT_OPEN','cell'=>$cell['cellId']])}} ')">
                            {{ __('Light Start') }}
                    </a>
                    <a class="btn btn-sm btn-info mb-2"
                    onclick="get(' {{route('logistics.action',['machine'=>$machine->id,'action'=>'LIGHT_CLOSE','cell'=>$cell['cellId']])}} ')">
                       
                            {{ __('Light Stop') }}
                    </a>

                </div>

            </td>
            <td class="border d-none px-4 py-2">
               
            </td>
            <td class="border px-4 py-2">
                @if($cell['orderId']!==NULL)
                <p id="code{{$cell['orderId']}}">{{$cell['orderId']}}</p>
                <a class="bg-pink-300 hover:bg-pink-400 text-sm text-pink-800 font-bold py-2 px-4 rounded-r" 
                onclick="get(' {{route('logistics.action',['machine'=>$machine->id,'action'=>'CANCEL_ORDER','cell'=>$cell['orderId']])}} ') ">
                Cancel Order
                </a>
                <!-- <a class="btn btn-sm btn-block btn-dark mb-2" href="/58auv/order/get/{{$cell['orderId']}}">Pickup</a> -->
                <div id="qrcode{{$cell['orderId']}}" class="qrcode p-4"></div>

                <script type="text/javascript">
                    new QRCode(document.getElementById("qrcode{{$cell['orderId']}}"), document.getElementById(
                        "code{{$cell['orderId']}}").innerText);

                </script>
                @endif
            </td>
        </tr>
        @endforeach

    </tbody>
</table>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function get(link){
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        background: '#f2f4f6',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })
        Toast.fire({
        icon: 'info',
        title: 'Clicked. Waiting...'
        })
        Swal.showLoading()
        // alert('loading');
        var xhttp = new XMLHttpRequest();
        xhttp.open("GET",link,true);
        //Send the proper header information along with the request
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xhttp.onreadystatechange = function() {//Call a function when the state changes.
            if(xhttp.readyState == 4 && xhttp.status == 200) {
                // alert(xhttp.responseText.success);
                var res = JSON.parse(xhttp.responseText); 
                // alert(res.success);
                

                if(res.code == '10000'){
                    Toast.fire({
                    icon: 'success',
                    title: 'Successfully'
                    })
                } else {
                    Toast.fire({
                    icon: 'warning',
                    title: 'Ooops...'
                    })
                }

            
            }
        }

        xhttp.send();
    }
</script>

@endsection
