@extends('logistics.layout')

@section('content')

<!-- <div class="bg-indigo-900 text-center py-4 lg:px-4">
  <div class="p-2 bg-indigo-800 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
    <span class="flex rounded-full bg-indigo-500 uppercase px-2 py-1 text-xs font-bold mr-3">New</span>
    <span class="font-semibold mr-2 text-left flex-auto">Get the coolest t-shirts from our brand new store</span>
    <svg class="fill-current opacity-75 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"/></svg>
  </div>
</div> -->

<div class="row flex mb-4">
    @foreach($lists as $key => $store)
    
    @php
    if(!$store->active){
        continue;
    }
    if( $store->machines ){
    $machine = $store->machines->first();
    } else {
    $machine = null;
    }
    @endphp

    <div class="col-12 col-md-6 mt-4">

        <div class="card" style="max-width: 540px;">
            <div class="row no-gutters">
                <div class="d-none d-md-block col-md-4">
                    <img src="/images/store.jpg" class="card-img" style="height:100%;object-fit:cover">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{$store->name}}</h5>
                        <!-- <p class="card-text">{{$store->full_address}}</p> -->
                        <div class="card-text store-button">
                        @if($machine)
                        <a class="btn btn-primary " href="{{route('logistics.shelf',['store'=>$store->id,'machine'=>$machine->id])}}">
                        上貨 *預設售賣機
                        </a>
                        @else
                        <!-- <a href="" class="btn btn-outline-danger">
                        No Machines
                        </a> -->
                        @endif
                           
                            <a class="btn btn-info" href="{{route('logistics.machine',['store'=>$store->id ])  }}">
                                所有售賣機 
                            </a>
                        </div>
                        <p class="card-text"><small class="text-muted">
                                <p class="text-gray-900">預設售賣機: {{ ($machine)?$machine->name:'---' }}</p>
                        </small></p>
                        {{-- <p class="card-text"><small class="text-muted"><p class="text-gray-900 leading-none">Total Orders:</p></small></p> --}}
                    </div>
                </div>
            </div>
        </div>

    </div>

    @endforeach
</div>

@endsection
