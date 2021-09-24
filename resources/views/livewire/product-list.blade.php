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
                                    <h3 class="text-white text-md">{{ __(date('M',strtotime($date))) }}</h3>
                                </div>
                                <div class="py-3">
                                    <h2 class="text-2xl text-base-content font-bold">{{date('d',strtotime($date))}}</h2>
                                </div>
                                <div class="text-base-content pb-3 rounded-b-lg px-3 bottom-0 flex justify-between">
                                    <h3 class="text-md font-bold">{{ __(date('D',strtotime($date))) }}</h3>
                                    <h3 class="text-md font-bold">{{ date('Y',strtotime($date)) }}</h3>
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



            <div class="alert alert-info col-span-12">
                <div class="flex-1">
                    <svg stroke="#2196f3" class="w-6 h-6 mx-2" width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.85786 32.7574C6.23858 33.8432 4 35.3432 4 37C4 40.3137 12.9543 43 24 43V43C35.0457 43 44 40.3137 44 37C44 35.3432 41.7614 33.8432 38.1421 32.7574" stroke="#2196f3" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M24 35C24 35 37 26.504 37 16.6818C37 9.67784 31.1797 4 24 4C16.8203 4 11 9.67784 11 16.6818C11 26.504 24 35 24 35Z" fill="none" stroke="#2196f3" stroke-width="4" stroke-linejoin="round" />
                        <path d="M24 22C26.7614 22 29 19.7614 29 17C29 14.2386 26.7614 12 24 12C21.2386 12 19 14.2386 19 17C19 19.7614 21.2386 22 24 22Z" fill="none" stroke="#2196f3" stroke-width="4" stroke-linejoin="round" />
                    </svg>
                    <label class="animate-pulse font-bold">                          
                    {{$locationName}}
                    </label>
                </div>
            </div>


            @auth

            @php
            $bentos = auth()
            ->user()
            ->bentos()
            ->where([
            'status' => 'paid',
            'menu_date' => $menu_date,
            ])
            ->get();
            $codes = $bentos->groupBy('extraction_code');
            @endphp

            @if (count($bentos) > 0)
            <div class="col-span-12 w-full">
                <div class="w-full overflow-hidden">
                    <div class="grid grid-cols-12 gap-4 pb-4">
                        <h3 class="col-span-12 font-semibold">{{__('Extraction Code')}}:</h3>
                        @foreach ($codes as $code => $orders)
                        <div class="stat shadow rounded-box bg-base-200 col-span-6 md:col-span-4">
                            <div class="stat-figure text-info">
                                <div class="avatar">
                                    <div class="w-16 h-16 p-1 bg-base-100">
                                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=ecb{{$code}}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="text-sm"><code>{{ $code }}</code></div>
                            <a target="_blank" class="text-xs link link-primary" href="https://air.ecbento.com/qr/ecb{{$code}}">View Detail</a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="hidden md:flex col-span-12 w-full">
                <div class="w-full overflow-hidden">
                    <div class="grid grid-cols-12 gap-4 pb-4">
                        <h3 class="col-span-12 font-semibold">{{__('Ordered')}}:</h3>
                        @foreach ($bentos as $k => $bento)
                        <div class="stat text-xs shadow rounded-box bg-base-200 col-span-6 md:col-span-4">
                            <div class="stat-figure text-info">
                                <div class="avatar">
                                    <div class="w-16 h-16 p-1 mask mask-squircle bg-base-100">
                                        <img class="mask mask-squircle" src="{{ $bento->product->image_file ? $bento->product->image_file : 'https://www.kenyons.com/wp-content/uploads/2017/04/default-image-620x600.jpg' }}">
                                    </div>
                                </div>
                            </div>
                            <div>{{ $bento->product->title }}</div>
                        </div>


                        @endforeach
                    </div>
                </div>
            </div>

            @endif
            @endauth


            <h3 class="col-span-12 font-semibold">{{__('Menu')}}:</h3>
            @if($products)
            @foreach ($products as $product)
            <div wire:loading.remove wire:target="products" class="col-span-6 md:col-span-4 lg:col-span-4 xl:col-span-3 md:flex pb-8 w-full indicator">
                <div class="card bordered shadow-lg w-full rounded-box bg-base-200">
                    <figure class="px-4 pt-4">
                        <img src="{{$product->image_file? $product->image_file : 'https://www.kenyons.com/wp-content/uploads/2017/04/default-image-620x600.jpg'}}" class="h-40 object-cover object-center rounded-box bg-cover bg-center">
                    </figure>
                    <div class="card-body h-30 px-5 pt-4 pb-0">
                        <span class="menu-title text-opacity-50 text-xs text-gray-800">
                            @php
                            try {
                                //$product->brand->name;
                            } catch (\Throwable $th) {
                                //$product->id;
                            }
                            $periodEnd = $periodId->preorder_end;
                            $stock = 1;
                            @endphp
                        </span>
                        <h4 class="font-bold text-xs lg:text-md">
                            {{$product->title}}
                        </h4>
                        <p class="hidden lg:block text-xs mt-2">{{ mb_strimwidth($product->description, 0, 50, "...") }}</p>

                    </div>


                    <div class="pb-4 px-5 w-full mt-3 justify-between">
                        <h3 class="text-md font-bold mb-3">
                            ${{$product->price}}
                        </h3>

                        @if($stock <= 0)
                        <button disabled class="btn btn-primary btn-block btn-sm text-sm m-0 rounded-lg">{{__('Sold Out')}}</button>
                        @else
                            @auth
                            <button wire:click="addToCart({{$product->id}},'{{$menu_date}}')" class="btn btn-primary btn-block btn-sm text-sm m-0 rounded-lg">{{__('Add To Cart')}}</button>
                            @else
                            <a href="{{route('login')}}" class="btn btn-primary btn-block btn-sm text-sm m-0 rounded-lg">{{__('Add To Cart')}}</a>
                            @endauth
                        @endif
                        
                        
                    </div>
                </div>
                <!-- ordered -->
                
            </div>
            @endforeach
            @endif
            @livewire('add-cart')
            <div class="col-span-12" wire:loading wire:target="products">

            Processing Menu...

            </div>

    </div>

    </div>
  
</div>