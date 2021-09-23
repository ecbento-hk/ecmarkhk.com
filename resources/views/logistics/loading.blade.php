@extends('logistics.layout')

@section('content')
<style>
    a:hover {
    text-decoration:underline;
    background-color:#fafafa;
    color:gray;
    }
    a:active {
    text-decoration:none;
    background-color:gray;
    color:#fafafa;
    }
</style>
@php
    $machineType = $machine->type;
    $machineId = $machine->id;

    $menuDate = date('Y-m-d');
    // if(date('w')==6){
    //         $menuDate = date( "Y-m-d", strtotime( "$menuDate 1 day" ) );
    // }
    if(date('w')==7){
            $menuDate = date( "Y-m-d", strtotime( "$menuDate +1 day" ) );
    }
    if(date('H')>=21){
        $menuDate = date( "Y-m-d", strtotime( "$menuDate +1 day" ) );
    }
  
    $menu = \App\Menu::where([
            'menu_date'=>$menuDate,
            'period_id'=>'2',
        ])->first();
    $orders = \App\OrderItem::where([
        'menu_date'=>$menuDate,
        'store_id' => $store->id,
        'status' => 'paid'
        ])->get();
@endphp
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="/js/qrcode.min.js"></script>
<style>
    .qrcode img {
        width: 100%;
        max-width: 100px;
    }
    .product-title {
        font-size:80%;
    }

    .card {
        background-color: var(--white);
        -webkit-box-shadow: 0 2px 4px 0 rgba(0,0,0,.05);
        box-shadow: 0 2px 4px 0 rgba(0,0,0,.05);
        border-radius: .5rem;
    }

</style>

<div class="row">
<div class="col-12 col-md-6">
<div class="card mb-4 mt-4" style="max-width: 500px;">
  <div class="card-body">
    <h5 class="card-title"><span class="badge badge-primary">{{strtoupper($machine->type)}}</span></h5>
    <!-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> -->
    <h3 class="card-text">機名: {{$machine->name}}</h3>
    <!-- <p class="card-text">飯盒數: {{count($lists)}}</p> -->
    <p class="card-text">訂單數: {{$orders->sum('quantity')}} / Buffer: {{\App\MenuLocationStock::where([
        'store_id' => $store->id,
        'menu_id' => $menu->id,
        'active' => 1
    ])->get()->sum('stock')}}</p>
    <p class="card-text"><small>IMEI: <code style="color:red">{{$machine->imei}}</code></small></p>
    <a href="{{route('logistics.machine',['store'=>$store->id ])  }}" class="card-link">上一頁</a>
    <a href="{{route('logistics.sendFcmByStore',['store'=>$store->id ])  }}" class="card-link">通知客人</a>
    <a href="{{route('logistics.machine.status',['store'=>$store->id, 'machine'=>$machine->id ])  }}" class="card-link">狀態/後台</a>
  </div>
</div>
</div></div>

@if($machineType=='foodlocker')
    @if($store->id !== 54)
    <div class="card">
    <table class="table mt-4" style="width:100%">
        <thead>
            <tr>
                <td class="d-none d-md-block border px-4 py-2">ID</td>
                <td class="border px-4 py-2">User</td>
                <td class="border px-4 py-2">Product</td>
                <td class="border px-4 py-2">Cell</td>
                <td class="border px-4 py-2">Code</td>
                <td class="d-none d-md-block border px-4 py-2">Status</td>
                <!-- <td class="border px-4 py-2">Created at</td> -->
                <!-- <td class="border px-4 py-2">Take Time</td> -->
                <td class="border px-4 py-2">Size</td>
            </tr>
        </thead>
        <tbody>

            @foreach(\App\Order::where('payment_status','paid')->where('refund_status','no_request')->whereIn('id',$lists->pluck('order_id'))->get() as $key => $list)
            <tr>
              
                <td class="border px-4 py-2"><a href="/58auv/orders/{{$list->id}}" id="code{{$list->id}}" >{{$list->id}}</a><br>
                <div id="qrcode{{$list->id}}" class="qrcode p-4"></div>

                <script type="text/javascript">
                    new QRCode(document.getElementById("qrcode{{$list->id}}"), 'ecb'+document.getElementById(
                        "code{{$list->id}}").innerText);

                </script>
                </td>
                <td class="product-title border px-4 py-2"><a href="/58auv/orders/{{$list->id}}">{{\App\User::find($list->user_id)->name}}</a></td>
                <td class="border px-4 py-2">
                    @foreach ($list->items()->where('menu_date',$menuDate)->get() as $item)
                    <span> {{$item->period}} - </span>
                    <small>
                        @php
                        $product = \App\Http\Api\V1\Model\Product\Product::find($item->product_id);
                        if($product){
                            echo '<span class="text-left">'.$product->title .' x '. $item->quantity.'</span><span class="text-right">......'.$item->ship_status.'</span><br>';
                        } else {
                            echo $item->product_id;
                        }
                        @endphp
                    </small>
                    @endforeach
                </td>
                <td class="border px-4 py-2">
                    @php
                    $cell = 0;
                    $track =
                    \App\Http\Api\V1\Model\MachineProduct::where('product_type','like','%Order%')->whereDate('created_at', date('Y-m-d'))->where('product_id',$list->id)->first();
                    if($track){
                    $cell = $track->track_x;
                    echo '<br>';
                    echo $cell;
                    }
                    @endphp
                </td>
                <td class="border px-4 py-2">
                    <code style="color:red">{{$list->extraction_code}}</code>
                </td>

                <td class="d-none d-md-block border px-4 py-2">
                    {{strtoupper($list->payment_status)}}
                </td>

                <!-- <td class="border px-4 py-2">{{$list->created_at}}</td> -->
                <!-- <td>{{$list['extraction_start']}}</td> -->
                <td class="border px-4 py-2">
                    @if($list->payment_status!='cancelled' && $list->payment_status=='paid' && $cell == 0)
                    <div class="inline-flex">

                
                    <a href="/logistics/machine/{{$machineId}}/order/create/{{$list->id}}/1">
                    <button class="bg-indigo-300 btn-block hover:bg-indigo-400 text-sm text-indigo-800 font-bold py-2 px-4 rounded-l">
                        {{ __('Small') }}
                    </button>
                    </a>
                    <a href="/logistics/machine/{{$machineId}}/order/create/{{$list->id}}/2">
                    <button class="bg-pink-300 btn-block hover:bg-pink-400 text-sm text-pink-800 font-bold py-2 px-4 rounded-r">
                        {{ __('Big') }}
                    </button>
                    </a>

                    </div>

                    @else
                        @if($list->items()->max('ship_status')=='ready')
                            @if( count(explode(',',$cell)) <= 1 )
                            <a href="{{route('logistics.action',['machine'=>$machineId,'action'=>'DOOR_OPEN','cell'=>$cell])}}">
                            <button class="bg-gray-300 hover:bg-gray-400 text-sm text-gray-800 font-bold py-2 px-4 rounded">
                                {{__('Temp Open')}}
                            </button>
                            </a>
                            @endif
                        <a href="{{route('logistics.add',['machine'=>$machineId,'orderId'=>$list->id,'boxSize'=>1])}}">
                        <button class="bg-gray-300 hover:bg-gray-400 text-sm text-gray-800 font-bold py-2 px-4 rounded">
                                {{__('Add - Small')}}
                        </button>
                        </a>
                        <a href="{{route('logistics.add',['machine'=>$machineId,'orderId'=>$list->id,'boxSize'=>2])}}">
                        <button class="bg-gray-300 hover:bg-gray-400 text-sm text-gray-800 font-bold py-2 px-4 rounded">
                                {{__('Add - Big')}}
                        </button>
                        </a>
                        @else 
                        
                        @endif
                    @endif
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>

  
  </div>
  @endif

    <h5 class="mt-5">For Buffer</h5>
    <table class="table mt-4 w-100" style="width:100%">
        <thead>
            <tr>
                <td class="d-none d-md-block border px-4 py-2">ID</td>
                <td class="border px-4 py-2">User</td>
                <td class="border px-4 py-2">Product</td>
                <td class="border px-4 py-2">Cell</td>
                <td class="d-none d-md-block border px-4 py-2">Code</td>
                <td class="d-none d-md-block border px-4 py-2">Status</td>
                <td class="border px-4 py-2">Size</td>
            </tr>
        </thead>
        <tbody>
            <!-- for lunch -->
            @foreach(\App\MenuLocationStock::where([
                'store_id' => $store->id,
                'menu_id' => $menu->id,
            ])->get() as $key => $list)
            @if(true)
            @for ($i = 0; $i < 1; $i++)
            <tr>
                <td class="d-none d-md-block border px-4 py-2"><a id="code{{$list->id}}" ><code>lunch</code> <br>{{$list->product_id}}</a><br>
                <div id="qrcode{{$list->id}}" class="qrcode p-4"></div>

                <!-- <script type="text/javascript">
                    new QRCode(document.getElementById("qrcode{{$list->id}}"), 'open'+document.getElementById(
                        "code{{$list->id}}").innerText);

                </script> -->
                </td>
                <td class="border px-4 py-2">Buffer</td>
                <td class="product-title border px-4 py-2">
                   {{$list->product->title}}
                   <br>
                   Orders: <code style="color:red">{{ $todayOrder = \App\OrderItem::where([
                        'menu_date'=>date('Y-m-d'),
                        'status'=>'paid',
                        'store_id'=>$store->id,
                        'product_id'=>$list->product->id
                    ])->sum('quantity')}} </code> / Buffer:  <code style="color:red"> 
                    @php
                        $todayBuffer = \App\MenuLocationStock::where([
                            'menu_id' =>  $menu->id,
                            'store_id'=>$store->id,
                            'product_id'=>$list->product->id
                        ])->first();
                        $todayBuffer = $todayBuffer?$todayBuffer->real_stock:0; 
                        echo $todayBuffer;
                    @endphp
                    </code> 
                </td>
                <td class="border px-4 py-2">
                    @php
                    $cell = 0;
                    $track = \App\Http\Api\V1\Model\MachineProduct::where('product_type','like','%MenuLocationStock%')->where('machine_id',$machine->id)->whereDate('created_at', date('Y-m-d'))->where('product_id',$list->product_id)->get();
                    if($track){
                        foreach ($track as $key => $xy) {
                            $cell = $xy->track_x;
                            if($xy->active == 0){
                                echo '<del>'.$cell.'</del>,';
                            } else {
                                $url = route('logistics.action',['machine'=>$xy->machine_id,'action'=>'DOOR_OPEN','cell'=>$cell]);
                                echo '<a class="cursor-pointer" onclick="get(\''.$url.'\')">'.$cell.'</a>, ';
                            }
                        }
                    }
                    @endphp
                </td>
                <td class="d-none d-md-block border px-4 py-2">
                    ---
                </td>

                <td class="d-none d-md-block border px-4 py-2">
                    ---
                </td>

                <!-- <td class="border px-4 py-2">{{$list->created_at}}</td> -->
                <!-- <td>{{$list['extraction_start']}}</td> -->
                <td class="border px-4 py-2">
              
                    <div class="inline-flex">

                
                    <a href="/logistics/machine/{{$machineId}}/product/create/{{$list->product_id}}/1">
                    <button class="mb-2 btn btn-sm btn-block btn-primary hover:bg-indigo-400 text-sm text-indigo-800 font-bold py-2 px-4 rounded-l">
                        {{ __('Small') }}
                    </button>
                    </a>
                    <a href="/logistics/machine/{{$machineId}}/product/create/{{$list->product_id}}/2">
                    <button class="mb-2 btn btn-sm btn-block btn-primary hover:bg-pink-400 text-sm text-pink-800 font-bold py-2 px-4 rounded-r">
                        {{ __('Big') }}
                    </button>
                    </a>

                    <br>
                    
                        <button onclick="get('https://air.ecbento.com/logistics/machine/{{$machineId}}/product/create/{{$list->product_id}}/1',{{ $todayOrder+$todayBuffer }})"  class="mb-2 btn btn-sm btn-block btn-success hover:bg-success-400 text-sm text-success-800 font-bold py-2 px-4 rounded-r">
                            {{ __('一鍵上飯') }}
                        </button>
                        <button onclick="get('https://air.ecbento.com/logistics/machine/{{$machineId}}/product/create/{{$list->product_id}}/2',{{ $todayOrder+$todayBuffer }})"  class="mb-2 btn btn-sm btn-block btn-success hover:bg-success-400 text-sm text-success-800 font-bold py-2 px-4 rounded-r">
                            {{ __('一鍵上飯') }} {{ __('Big') }}
                        </button>

                    </div>

                </td>
            </tr>
            
            @endfor
            @endif
            @endforeach

            <tr>
                <td class="d-none d-md-block border px-4 py-2"><a id="code999" ><code>lunch</code> <br>{{'1985'}}</a><br>
                
                </td>
                <td class="border px-4 py-2">Buffer</td>
                <td class="product-title border px-4 py-2">
                    @php
                        $product = \App\Http\Api\V1\Model\Product\Product::find(1985);
                        if($product){
                            $product = $product->title;
                        } else {
                            $product = '白飯';
                        }
                    @endphp
                </td>
                <td class="border px-4 py-2">
                    @php
                    $cell = 0;
                    $track = \App\Http\Api\V1\Model\MachineProduct::where('product_type','like','%MenuLocationStock%')->where('machine_id',$machine->id)->whereDate('created_at', date('Y-m-d'))->where('product_id','1985')->get();
                    if($track){
                        foreach ($track as $key => $xy) {
                            $cell = $xy->track_x;
                            echo $cell.', ';
                        }
                    }
                    @endphp
                </td>
                <td class="d-none d-md-block border px-4 py-2">
                    ---
                </td>
            
                <td class="d-none d-md-block border px-4 py-2">
                    ---
                </td>
            
                <td class="border px-4 py-2">
              
                    <div class="inline-flex">
            
                
                    <a href="/logistics/machine/{{$machineId}}/product/create/{{'1985'}}/1">
                    <button class="mb-2 btn btn-sm btn-block btn-primary hover:bg-indigo-400 text-sm text-indigo-800 font-bold py-2 px-4 rounded-l">
                        {{ __('Small') }}
                    </button>
                    </a>
                    <a href="/logistics/machine/{{$machineId}}/product/create/{{'1985'}}/2">
                    <button class="mb-2 btn btn-sm btn-block btn-primary hover:bg-pink-400 text-sm text-pink-800 font-bold py-2 px-4 rounded-r">
                        {{ __('Big') }}
                    </button>
                    </a>
            
                    </div>
            
                </td>
            </tr>

            <!-- for dinner -->
            @php 
            $periods = ['12','13','3','5','7','8','15'];
            $periods = ['13','3'];
            if($store->id == 54 && $machineType != 'foodlocker'){
            $periods = ['13','15'];
            }
            $dinnerMenu = \App\Menu::where([
                'menu_date'=>$menuDate,
            ])->orWhere('menu_date','8888-12-31')->whereIn('period_id',$periods)->get();
            $dinnerProduct = \App\MenuLocationStock::where([
                'store_id' => $store->id,
            ])->whereIn('menu_id',$dinnerMenu->pluck('id'),)->get();
            @endphp
            @if($dinnerProduct)
                @foreach($dinnerProduct as $key => $list)
                    @for ($i = 0; $i < 1; $i++)
                    <tr>
                        <td class="d-none d-md-block border px-4 py-2">
                            @if($list->menu_id == 1095)
                            <code>ec market</code> 
                            @else
                                @if(in_array($list->menu->period_id,['3','5']))
                                    <code>dinner</code> 
                                @elseif(in_array($list->menu->period_id,['12']))
                                    <code>soup</code> 
                                @elseif(in_array($list->menu->period_id,['13']))
                                    <code>addon</code> 
                                @elseif(in_array($list->menu->period_id,['15']))
                                    <code>ecmart</code> 
                                @else
                                    <code>other</code> 
                                @endif
                            @endif
                           <br>{{$list->product_id}}</a><br>
                        </td>
                        <td class="border px-4 py-2">Buffer</td>
                        <td class="product-title border px-4 py-2">
                        {{$list->product->title}}
                        </td>
                        <td class="border px-4 py-2">
                            @php
                            $cell = 0;
                            if($list->menu_id == 1095){
                                $track = \App\Http\Api\V1\Model\MachineProduct::where('product_type','like','%MenuLocationStock%')->where('machine_id',$machine->id)->where('product_id',$list->product_id)->get();
                            } else {
                                $track = \App\Http\Api\V1\Model\MachineProduct::where('product_type','like','%MenuLocationStock%')->where('machine_id',$machine->id)->whereDate('created_at', date('Y-m-d'))->where('product_id',$list->product_id)->get();
                            }

                            if($track){
                                foreach ($track as $key => $xy) {
                                    $cell = $xy->track_x;
                                    echo $cell.', ';
                                }
                            }
                            @endphp
                        </td>
                        <td class="d-none d-md-block border px-4 py-2">
                            ---
                        </td>

                        <td class="d-none d-md-block border px-4 py-2">
                            ---
                        </td>

                        <!-- <td class="border px-4 py-2">{{$list->created_at}}</td> -->
                        <!-- <td>{{$list['extraction_start']}}</td> -->
                        <td class="border px-4 py-2">
                    
                            <div class="inline-flex">

                        
                            @if($list->menu_id == 1095)

                            <a href="/logistics/machine/{{$machineId}}/product/create/{{$list->product_id}}/1/0">
                            <button class="btn btn-sm btn-warning mb-2 text-sm text-indigo-800 font-bold py-2 px-4 rounded-l">
                                {{ __('Small X熱') }}
                            </button>
                            </a>
                            <a href="/logistics/machine/{{$machineId}}/product/create/{{$list->product_id}}/2/0">
                            <button class="btn btn-sm btn-warning mb-2 text-sm text-pink-800 font-bold py-2 px-4 rounded-r">
                                {{ __('Big X熱') }}
                            </button>
                            </a>
                            
                            @else
                            
                            <a href="/logistics/machine/{{$machineId}}/product/create/{{$list->product_id}}/1">
                            <button class="btn btn-sm btn-primary mb-4 text-sm text-indigo-800 font-bold py-2 px-4 rounded-l">
                                {{ __('Small') }}
                            </button>
                            </a>
                            <a href="/logistics/machine/{{$machineId}}/product/create/{{$list->product_id}}/2">
                            <button class="btn btn-sm btn-primary mb-4 text-sm text-pink-800 font-bold py-2 px-4 rounded-r">
                                {{ __('Big') }}
                            </button>
                            </a>
                            
                            @endif

                            

                            </div>

                        </td>
                    </tr>
                    @endfor
                @endforeach
            @endif
        </tbody>
    </table>

   
@else

    <div class="card mt-4" style="width:100%">
        <div class="card-header">
            <div class="card-title">Products</div>
        </div>
        <div class="card-body p-0">
            <table class="table p-0" style="width:100%">
                <thead>
                    <tr>
                        <!-- <td>ID</td> -->
                        <td class="d-none d-md-block">Image</td>
                        <td>Product</td>
                        <td class="d-none d-md-block">Total</td>
                        <td>Track</td>
                        <td width="200px">XY</td>
                        <td width="200px">Action</td>
                    </tr>
                </thead>
                <tbody>

                    @foreach($lists as $key => $list)
                
                    @php
                    $product = \App\Http\Api\V1\Model\Product\Product::find($list->product_id);
                    if(!$product){
                        continue;
                    }
                    if($list->active == 0){
                        continue;
                    }
                    @endphp
                    <tr>
                    
                        <form action="{{route('logistics.create',['machine'=>$machineId, 'orderClass'=>'product','orderId'=>$product->id,'boxSize'=>1])}}" method="POST">
                        <!-- <td>{{$key}}</td> -->
                        <td class="d-none d-md-block"><img src="{{$product->image}}" width="50px"></td>
                        <td>
                            {{$product->id}}
                            {{$product->title}} 
                            <br>
                            Orders: <code style="color:red">{{ $todayOrder = \App\OrderItem::where([
                                'menu_date'=>date('Y-m-d'),
                                'status'=>'paid',
                                'store_id'=>$store->id,
                                'product_id'=>$product->id
                            ])->sum('quantity')}} </code> / Buffer:  <code style="color:red"> 
                            @php
                                $todayBuffer = \App\MenuLocationStock::where([
                                    'menu_id' =>  $menu->id,
                                    'store_id'=>$store->id,
                                    'product_id'=>$product->id
                                ])->first();
                                $todayBuffer = $todayBuffer?$todayBuffer->real_stock:0; 
                                echo $todayBuffer;
                            @endphp
                            </code> 
                        </td>
                        <td class="d-none d-md-block">{{ ($todayOrder +$todayBuffer) }}</td>
                        <td>
                            <!-- Y:0 / X:0 -->
                            @php
                            $machineProducts = \App\Http\Api\V1\Model\MachineProduct::where(['product_id'=>$product->id,'machine_id'=>$machineId,'product_type'=>'App\Http\Api\V1\Model\Product\Product'])->orderBy('track_y', 'asc')->orderBy('track_x')->get();
                            @endphp
                            @if($machineProducts)
                            @foreach($machineProducts as $machineProduct)
                            <span class="badge badge-primary mb-3">{{ chr(64 + $machineProduct->track_y) }}{{$machineProduct->track_x}} : {{$machineProduct->stock .' / '. ( $machineProduct->sold_count) }}</span> <span><a href="{{ route('logistics.track.delete',['machineProduct' => $machineProduct->id ] )}}">Delete</a></span>
                            <br>
                            @endforeach
                            @endif
                        </td>
                        <td>
                        From: <br>
                        <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <select id="track_y" name="track_y" dusk="track_y" class="w-full form-control form-select" required>
                                        <option value="" selected="selected" disabled="disabled">Y</option>
                                        @for($char = 'A'; $char < 'Z' ; $char++)
                                            <option value="{{$char}}">{{$char}}</option>
                                        @endfor
                                    </select>
                                </div>
                                <select id="track_x" name="track_x" dusk="track_x" class="w-full form-control form-select" required>
                                    <option value="" selected="selected" disabled="disabled">X</option>
                                    @for ($i = 0; $i < 7; $i++) <option value="{{$i+1}}">{{$i+1}}</option>
                                        @endfor
                                </select>
                            </div>
                        <br>To: <br>
                        <div class="input-group mb-3">
                                <select name="to_track_x" dusk="to_track_x" class="w-full form-control form-select">
                                    <option value="" selected="selected" disabled="disabled">X</option>
                                    @for ($i = 0; $i < 7; $i++) <option value="{{$i+1}}">{{$i+1}}</option>
                                        @endfor
                                </select>
                            </div>
                       <br>
                            <div class="input-group mb-3">
                                <input type="number" step="1" min="1" name="stock" class="form-control" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit">Add</button>
                                </div>
                            </div>

                        </td>
                        </form>
                        <td>
                            @if( ($todayOrder +$todayBuffer) > 0 )
                            <form id="form-{{$product->id}}" action="{{route('logistics.auto-create',['machine'=>$machineId, 'store'=>$store->id, 'orderClass'=>'product','product'=>$product->id,'boxSize'=>1])}}" method="POST">
                            <button id="{{$product->id}}" class="btn btn-info btn-block" onclick="myButtonClicked(this)" type="submit">Auto</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach

                    @php
                    $product = \App\Http\Api\V1\Model\Product\Product::find(1985);
                    @endphp
                    <tr>
                    
                        <form action="{{route('logistics.create',['machine'=>$machineId, 'orderClass'=>'product','orderId'=>$product->id,'boxSize'=>1])}}" method="POST">
                        <!-- <td>{{$key}}</td> -->
                        <td class="d-none d-md-block "><img src="{{$product->image}}" width="50px"></td>
                        <td>
                            {{$product->id}}
                            {{$product->title}} 
                        </td>
                        <td class="d-none d-md-block"></td>
                        <td>
                            <!-- Y:0 / X:0 -->
                            @php
                            $machineProducts = \App\Http\Api\V1\Model\MachineProduct::where(['product_id'=>$product->id,'machine_id'=>$machineId,'product_type'=>'App\Http\Api\V1\Model\Product\Product'])->orderBy('track_y', 'asc')->orderBy('track_x')->get();
                            @endphp
                            @if($machineProducts)
                            @foreach($machineProducts as $machineProduct)
                            <span class="badge badge-primary mb-3">{{ chr(64 + $machineProduct->track_y) }}{{$machineProduct->track_x}} : {{$machineProduct->stock .' / '. ( $machineProduct->sold_count) }}</span> <span><a href="{{ route('logistics.track.delete',['machineProduct' => $machineProduct->id ] )}}">Delete</a></span>
                            <br>
                            @endforeach
                            @endif
                        </td>
                        <td>
                        From: <br>
                        <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <select id="track_y" name="track_y" dusk="track_y" class="w-full form-control form-select" required>
                                        <option value="" selected="selected" disabled="disabled">Y</option>
                                        @for($char = 'A'; $char < 'Z' ; $char++)
                                            <option value="{{$char}}">{{$char}}</option>
                                        @endfor
                                    </select>
                                </div>
                                <select id="track_x" name="track_x" dusk="track_x" class="w-full form-control form-select" required>
                                    <option value="" selected="selected" disabled="disabled">X</option>
                                    @for ($i = 0; $i < 7; $i++) <option value="{{$i+1}}">{{$i+1}}</option>
                                        @endfor
                                </select>
                            </div>
                        <br>To: <br>
                        <div class="input-group mb-3">
                                <select name="to_track_x" dusk="to_track_x" class="w-full form-control form-select">
                                    <option value="" selected="selected" disabled="disabled">X</option>
                                    @for ($i = 0; $i < 7; $i++) <option value="{{$i+1}}">{{$i+1}}</option>
                                        @endfor
                                </select>
                            </div>
                       <br>
                            <div class="input-group mb-3">
                                <input type="number" step="1" min="1" name="stock" class="form-control" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit">Add</button>
                                </div>
                            </div>

                        </td>
                        </form>
                        <td>
                           
                            <form id="form-{{$product->id}}" action="{{route('logistics.auto-create',['machine'=>$machineId, 'store'=>$store->id, 'orderClass'=>'product','product'=>$product->id,'boxSize'=>1])}}" method="POST">
                            <button id="{{$product->id}}" class="btn btn-info btn-block" onclick="myButtonClicked(this)" type="submit">Auto</button>
                            </form>
                        
                        </td>
                    </tr>
                    @php
                    $product = \App\Http\Api\V1\Model\Product\Product::find(2010);
                    @endphp
                    <tr>
                    
                        <form action="{{route('logistics.create',['machine'=>$machineId, 'orderClass'=>'product','orderId'=>$product->id,'boxSize'=>1])}}" method="POST">
                        <!-- <td>{{$key}}</td> -->
                        <td class="d-none d-md-block "><img src="{{$product->image}}" width="50px"></td>
                        <td>
                            {{$product->id}}
                            {{$product->title}} 
                        </td>
                        <td class="d-none d-md-block"></td>
                        <td>
                            <!-- Y:0 / X:0 -->
                            @php
                            $machineProducts = \App\Http\Api\V1\Model\MachineProduct::where(['product_id'=>$product->id,'machine_id'=>$machineId,'product_type'=>'App\Http\Api\V1\Model\Product\Product'])->orderBy('track_y', 'asc')->orderBy('track_x')->get();
                            @endphp
                            @if($machineProducts)
                            @foreach($machineProducts as $machineProduct)
                            <span class="badge badge-primary mb-3">{{ chr(64 + $machineProduct->track_y) }}{{$machineProduct->track_x}} : {{$machineProduct->stock .' / '. ( $machineProduct->sold_count) }}</span> <span><a href="{{ route('logistics.track.delete',['machineProduct' => $machineProduct->id ] )}}">Delete</a></span>
                            <br>
                            @endforeach
                            @endif
                        </td>
                        <td>
                        From: <br>
                        <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <select id="track_y" name="track_y" dusk="track_y" class="w-full form-control form-select" required>
                                        <option value="" selected="selected" disabled="disabled">Y</option>
                                        @for($char = 'A'; $char < 'Z' ; $char++)
                                            <option value="{{$char}}">{{$char}}</option>
                                        @endfor
                                    </select>
                                </div>
                                <select id="track_x" name="track_x" dusk="track_x" class="w-full form-control form-select" required>
                                    <option value="" selected="selected" disabled="disabled">X</option>
                                    @for ($i = 0; $i < 7; $i++) <option value="{{$i+1}}">{{$i+1}}</option>
                                        @endfor
                                </select>
                            </div>
                        <br>To: <br>
                        <div class="input-group mb-3">
                                <select name="to_track_x" dusk="to_track_x" class="w-full form-control form-select">
                                    <option value="" selected="selected" disabled="disabled">X</option>
                                    @for ($i = 0; $i < 7; $i++) <option value="{{$i+1}}">{{$i+1}}</option>
                                        @endfor
                                </select>
                            </div>
                      <br>
                            <div class="input-group mb-3">
                                <input type="number" step="1" min="1" name="stock" class="form-control" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit">Add</button>
                                </div>
                            </div>

                        </td>
                        </form>
                        <td>
                           
                            <form id="form-{{$product->id}}" action="{{route('logistics.auto-create',['machine'=>$machineId, 'store'=>$store->id, 'orderClass'=>'product','product'=>$product->id,'boxSize'=>1])}}" method="POST">
                            <button id="{{$product->id}}" class="btn btn-info btn-block" onclick="myButtonClicked(this)" type="submit">Auto</button>
                            </form>
                        
                        </td>
                    </tr>




                    @php
                    if($store->id==54){
                        $dinnerMenu = \App\Menu::where([
                            'menu_date'=>$menuDate,
                        ])->orWhere('menu_date','8888-12-31')->whereIn('period_id',['3','5','15'])->get();
                        $dinnerProduct = \App\MenuLocationStock::where([
                            'store_id' => $store->id,
                            'active' => 1
                        ])->whereIn('menu_id',$dinnerMenu->pluck('id'),)->get();
                    } else {
                        $dinnerMenu = \App\Menu::where([
                            'menu_date'=>$menuDate,
                        ])->orWhere('menu_date','8888-12-31')->whereIn('period_id',['3','5','7','8'])->get();
                        $dinnerProduct = \App\MenuLocationStock::where([
                            'store_id' => $store->id,
                            'active' => 1
                        ])->whereIn('menu_id',$dinnerMenu->pluck('id'),)->get();
                    }
                    
                    @endphp

                    @if($dinnerProduct)
                    @foreach($dinnerProduct as $key => $list)                
                    @php
                    $product = \App\Http\Api\V1\Model\Product\Product::find($list->product_id);
                    if(!$product){
                        continue;
                    }
                    @endphp
                    <tr style="background:#ffebee!important">
                    
                        <form action="{{route('logistics.create',['machine'=>$machineId, 'orderClass'=>'product','orderId'=>$product->id,'boxSize'=>1])}}" method="POST">
                        <!-- <td>{{$key}}</td> -->
                        <td class="d-none d-md-block "><img src="{{$product->image}}" width="50px"></td>
                        <td>
                            #{{$product->id}}
                            {{$product->title}} 
                            <br>
                            Orders: <code style="color:red">{{ $todayOrder = \App\OrderItem::where([
                                'menu_date'=>date('Y-m-d'),
                                'status'=>'paid',
                                'store_id'=>$store->id,
                                'product_id'=>$product->id
                            ])->sum('quantity')}} </code> / Buffer:  <code style="color:red"> 
                            @php
                                $todayBuffer = \App\MenuLocationStock::where([
                                    'menu_id' =>  $menu->id,
                                    'store_id'=>$store->id,
                                    'product_id'=>$product->id
                                ])->first();
                                $todayBuffer = $todayBuffer?$todayBuffer->real_stock:0; 
                                echo $todayBuffer;
                            @endphp
                            </code> 
                        </td>
                        <td class="d-none d-md-block">{{ ($todayOrder +$todayBuffer) }}</td>
                        <td>
                            <!-- Y:0 / X:0 -->
                            @php
                            $machineProducts = \App\Http\Api\V1\Model\MachineProduct::where(['product_id'=>$product->id,'machine_id'=>$machineId,'product_type'=>'App\Http\Api\V1\Model\Product\Product'])->orderBy('track_y', 'asc')->orderBy('track_x')->get();
                            @endphp
                            @if($machineProducts)
                            @foreach($machineProducts as $machineProduct)
                            <span class="badge badge-primary mb-3">{{ chr(64 + $machineProduct->track_y) }}{{$machineProduct->track_x}} : {{$machineProduct->stock .' / '. ( $machineProduct->sold_count) }}</span> <span><a href="{{ route('logistics.track.delete',['machineProduct' => $machineProduct->id ] )}}">Delete</a></span>
                            <br>
                            @endforeach
                            @endif
                        </td>
                        <td>
                        From: <br>
                        <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <select id="track_y" name="track_y" dusk="track_y" class="w-full form-control form-select" required>
                                        <option value="" selected="selected" disabled="disabled">Y</option>
                                        @for($char = 'A'; $char < 'Z' ; $char++)
                                            <option value="{{$char}}">{{$char}}</option>
                                        @endfor
                                    </select>
                                </div>
                                <select id="track_x" name="track_x" dusk="track_x" class="w-full form-control form-select" required>
                                    <option value="" selected="selected" disabled="disabled">X</option>
                                    @for ($i = 0; $i < 7; $i++) <option value="{{$i+1}}">{{$i+1}}</option>
                                        @endfor
                                </select>
                            </div>
                        <br>To: <br>
                        <div class="input-group mb-3">
                                <select name="to_track_x" dusk="to_track_x" class="w-full form-control form-select">
                                    <option value="" selected="selected" disabled="disabled">X</option>
                                    @for ($i = 0; $i < 7; $i++) <option value="{{$i+1}}">{{$i+1}}</option>
                                        @endfor
                                </select>
                            </div>
                     <br>
                            <div class="input-group mb-3">
                                <input type="number" step="1" min="1" name="stock" class="form-control" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit">Add</button>
                                </div>
                            </div>

                        </td>
                        </form>
                        <td>
                            @if( ($todayOrder +$todayBuffer) > 0 )
                            <form id="form-{{$product->id}}" action="{{route('logistics.auto-create',['machine'=>$machineId, 'store'=>$store->id, 'orderClass'=>'product','product'=>$product->id,'boxSize'=>1])}}" method="POST">
                            <button id="{{$product->id}}" class="btn btn-info btn-block" onclick="myButtonClicked(this)" type="submit">Auto</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    
@endif
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function myButtonClicked(el)
    {
        el.disabled = true; 
        document.getElementById('form-'+el.id).submit();
    }
</script>
{{-- <script type="text/javascript">
    const html5QrCode = new Html5Qrcode("reader");
    // File based scanning
    const fileinput = document.getElementById('qr-input-file');
    fileinput.addEventListener('change', e => {
        if (e.target.files.length == 0) {
            return;
        }
        const imageFile = e.target.files[0];
        html5QrCode.scanFile(imageFile, /* showImage= */true)
        .then(qrCodeMessage => {
            console.log(qrCodeMessage);
        })
        .catch(err => {
            console.log(`Error scanning file. Reason: ${err}`)
        });
    });
    </script> --}}



<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function get(link, time = 0){
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
        if(time>0){
            for (let index = 0; index < time; index++) {
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
        } else {
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
    }
</script>

@endsection
