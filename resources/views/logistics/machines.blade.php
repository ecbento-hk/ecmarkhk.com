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
    @foreach($lists as $key => $machine)
  

    <div class="col-12 col-md-6 mt-4">

        <div class="card" style="max-width: 540px;background:#e8e8e8">
            <div class="row no-gutters">
                <div class="d-none d-md-block col-md-4">
                    @if($machine->type == 'pickup_machine')
                    <img src="/images/ecmachine.jpeg" class="card-img" style="height:100%; max-height:300px; object-fit:cover">
                    @else
                    <img src="/images/eclocker.jpeg" class="card-img" style="height:100%; max-height:300px; object-fit:cover">
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{$machine->name}}  {{ ($machine)?$machine->machine_types->name:'' }}</h5>
                        <div class="card-text store-button">
                            <a href="{{route('logistics.shelf',['store'=>$store->id,'machine'=>$machine->id])}}">
                                <button
                                    class="btn btn-primary bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                                    上貨
                                </button>
                            </a>
                            <a href="{{route('logistics.machine.status',['store'=>$store->id, 'machine'=>$machine->id ])  }}">
                                <button
                                    class="btn btn-primary bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    狀態
                                </button>
                            </a>
                        </div>
                        <p class="card-text mt-4">
                            <small class="text-muted text-gray-900">名稱: {{ ($machine)?$machine->name:'---' }}</small>
                            <br>
                            <small class="text-muted text-gray-900">類別: {{ ($machine)?$machine->machine_types->name:'---' }}</small>
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @endforeach
</div>

@endsection
