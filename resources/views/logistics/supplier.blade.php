@extends('logistics.layout')

@section('content')
<div class="flex flex-wrap mb-4">
    @foreach($lists as $key => $list)
    @php
        $supplier = \App\Http\Api\V1\Model\Supplier::find($list->brand_id);
    @endphp
    <div class="w-1/4 p-2">
        <div class="max-w-sm rounded overflow-hidden shadow-lg">
            <img class="w-full" src="{{$supplier->image}}" alt="{{$supplier->code}}" style="height:300px;object-fit:cover;">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">{{$supplier->name}}</div>
                <p class="text-gray-700 text-base">
                    {{$supplier->description}}
                </p>
                <div class="store-button">
                    <a href="{{route('logistics.checkin',['store'=>2])}}">
                        <button class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                           Check In
                        </button>
                    </a>
                </div>
            </div>
            <div class="px-6 pt-4 pb-2">
                {{-- @foreach(explode(',',$supplier->gps) as $key => $gps) --}}
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#{{ 'Alway Delay' }}</span>
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#{{ 'Taste Good' }}</span>
                {{-- @endforeach --}}
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
