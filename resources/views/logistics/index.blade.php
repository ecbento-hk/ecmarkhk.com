@extends('logistics.layout')

@section('content')

<div class="row flex mb-4">
    @foreach($lists as $key => $location)
    
    @php 
        $store = $location->store->where('active',1)->count();
        if($store<=0){
            continue;
        }
    @endphp
    <div class="col-6 col-md-4 mt-4">

        <div class="card" style="width: 100%;">
            <img src="{{'data:image/jpeg;base64,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'}}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{ ucfirst($location->name) }}</h5>
                <div class="card-text">
                    Total Store: <code>{{ count($location->store) }} </code><br>
                    Opening: <code>{{$store}}</code>
                </div>
                <a href="{{route('logistics.store',['location'=>$location->id])}}" class="btn btn-block mt-3 btn-primary">
                    Click
                </a>
            </div>
        </div>

            

    </div>

    @endforeach
</div>

@endsection