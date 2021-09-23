<div class="w-full">
    <!-- Remove py-8 -->
    <div class="">

        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 pb-1 w-full">

                <!-- <h3 class="mb-6">Menu Date: <code>{{$menu_date}}</code></h3> -->
                <div id="menu-date" class="w-full flex overflow-x-scroll pb-8 pl-2 -ml-2 lg:pl-0 lg:-ml-0 lg:pb-0 lg:overflow-x-visible">
                    <!-- <div class="grid grid-flow-col grid-cols-12 gap-4 py-4"> -->

                    @foreach($period as $date)
                    <div id="{{$date}}" class="{{$date==$menu_date?'flex':'lg:hidden flex'}} mr-4">
                        <a @if($date!==$menu_date) href="{{route('welcome')}}?menu={{base64_encode( serialize(['menu_date'=>$date]) )}}" @endif>
                            <div class="bg-base-200 shadow-lg w-32 block rounded-lg col-span-2 overflow-hidden text-center">
                                <div class="py-3 {{$menu_date===$date?'bg-primary':' bg-primary-focus cursor-pointer hover:shadow-lg'}}">
                                    <h3 class="text-white text-md">{{date('M',strtotime($date))}}</h3>
                                </div>
                                <div class="py-3">
                                    <h2 class="text-2xl text-base-content font-bold">{{date('d',strtotime($date))}}</h2>
                                </div>
                                <div class="text-base-content pb-3 rounded-b-lg px-3 bottom-0 flex justify-between">
                                    <h3 class="text-md font-bold">{{date('D',strtotime($date))}}</h3>
                                    <h3 class="text-md font-bold">{{date('Y',strtotime($date))}}</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                    @push('scripts')
                    <script>
                        $('#menu-date').scrollTo('#{{$menu_date}}')
                    </script>
                    @endpush
                </div>

            </div>

            @auth

            <div class="hidden col-span-12 pb-8 w-full">
                @php
                $bentos = auth()->user()->bentos()->where([
                'status' => 'paid',
                'menu_date' => $menu_date
                ])->get();
                @endphp
                <div class="w-full overflow-hidden">
                    @if(count($bentos)>0)
                    <h3>Ordered:</h3>
                    <div class="grid grid-cols-12 gap-4 py-4">
                        @foreach ($bentos as $bento)
                        <div class="shadow card col-span-4">
                            <div class="card-body p-3">
                                <h5 class="text-md">{{$bento->product->title}}</h5>
                                <p>Student: {{$bento->remark}}</p>
                            </div>
                        </div>



                        {{-- <div class="bg-base-200 shadow-lg mr-3 p-3"> 
                   <p>{{$bento->product->title}}</p>
                        <p>{{$bento->remark}}</p>
                    </div> --}}
                    @endforeach
                </div>
                @endif
            </div>
        </div>
        @endauth

        <h2 class="col-span-12">{{\App\Models\Store::find($location)->title}}</h2>

        @if(count($products)>0)
        @foreach ($products as $product)
        <div wire:loading.remove wire:loading.target="changeBrand" class="col-span-6 md:col-span-4 lg:col-span-4 xl:col-span-3 md:flex pb-8 w-full indicator">
            <div class="card bordered shadow-lg w-full rounded-box bg-base-200">
                <figure class="px-4 pt-4">
                    <img src="{{$product->image_file? $product->image_file : 'https://www.kenyons.com/wp-content/uploads/2017/04/default-image-620x600.jpg'}}" class="h-40 object-cover object-center rounded-box bg-cover bg-center">
                </figure>
                <div class="card-body h-30 px-5 pt-4 pb-0">
                    <span class="menu-title text-opacity-50 text-xs text-gray-800">
                        @php
                        try {
                        $product->brand->name;
                        } catch (\Throwable $th) {
                        $product->id;
                        }
                        @endphp
                    </span>
                    <h4 class="font-bold text-xs lg:text-md">
                        {{$product->title}}
                    </h4>
                    <p class="hidden lg:block text-xs mt-2">{{ mb_strimwidth($product->description, 0, 50, "...") }}</p>
                        
                </div>

                <div class="flex space-x-4 text-sm w-full px-6 pt-3 pb-6">
                        <a href="/" aria-label="Likes" class="flex items-start text-gray-800 transition-colors duration-200 hover:text-deep-purple-accent-700 group">
                            <div class="mr-2">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                class="w-4 h-4 text-gray-600 transition-colors duration-200 group-hover:text-deep-purple-accent-700"
                            >
                                <polyline points="6 23 1 23 1 12 6 12" fill="none" stroke-miterlimit="10"></polyline>
                                <path d="M6,12,9,1H9a3,3,0,0,1,3,3v6h7.5a3,3,0,0,1,2.965,3.456l-1.077,7A3,3,0,0,1,18.426,23H6Z" fill="none" stroke="currentColor" stroke-miterlimit="10"></path>
                            </svg>
                            </div>
                            <p class="font-semibold">{{$product->sold_count}}</p>
                        </a>
                        <a href="/" aria-label="Comments" class="flex items-start text-gray-800 transition-colors duration-200 hover:text-deep-purple-accent-700 group">
                            <div class="mr-2">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                stroke="currentColor"
                                class="w-4 h-4 text-gray-600 transition-colors duration-200 group-hover:text-deep-purple-accent-700"
                            >
                                <polyline points="23 5 23 18 19 18 19 22 13 18 12 18" fill="none" stroke-miterlimit="10"></polyline>
                                <polygon points="19 2 1 2 1 14 5 14 5 19 12 14 19 14 19 2" fill="none" stroke="currentColor" stroke-miterlimit="10"></polygon>
                            </svg>
                            </div>
                            <p class="font-semibold">{{$product->pivot->stock}}</p>
                        </a>
                    </div>
                <div class="pb-4 px-5 w-full mt-3 justify-between">
                    <h3 class="text-md font-bold mb-3">
                        ${{$product->price}}
                    </h3>
                    @auth
                    <button wire:click="addToCart({{$product->id}},'{{$menu_date}}')" class="btn btn-primary btn-block w-full btn-sm text-sm m-0 rounded-lg">{{__('Add To Cart')}}</button>
                    @else
                    <a href="{{route('login')}}" class="btn btn-primary btn-block btn-sm text-sm m-0 rounded-lg">{{__('Add To Cart')}}</a>
                    @endauth
                </div>
            </div>
            <!-- ordered -->
            @auth
                @php
                $ordered = \App\Models\Order\OrderItem::where([
                        'user_id'=>auth()->user()->id,
                        'product_id'=>$product->id,
                        'status'=>'paid',
                        'menu_date'=>$menu_date,
                    ])->exists();
                @endphp
                @if($ordered)
                <div class="indicator-item badge badge-info uppercase text-xs py-4" style="right:20px!important">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                @endif
            @endauth
        </div>
        @endforeach
        @endif
        @livewire('add-cart')
       {{-- @if ($products)
        <div class="col-span-12 px-4 py-8">
            {{ $products->links() }}
        </div>
        @endif --}}
    </div>

</div>
</div>