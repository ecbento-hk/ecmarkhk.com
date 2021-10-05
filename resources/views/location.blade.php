<x-app-layout>


    <main class="w-full mb-10">
    <div class="relative w-full h-full">
  <div class="absolute hidden w-full bg-gray-50 lg:block h-96"></div>
  <div class="relative px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
    <div class="max-w-xl mb-10 md:mx-auto sm:text-center lg:max-w-2xl md:mb-12">
      <h2 class="max-w-lg mb-6 font-sans text-3xl font-bold leading-none tracking-tight text-gray-900 sm:text-4xl md:mx-auto">
        {{__('Choose Your Location')}}
      </h2>
      <!-- <p class="text-base text-gray-700 md:text-lg">
        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque rem aperiam, eaque ipsa quae.
      </p> -->
    </div>
    <div class="grid max-w-screen-md gap-10 md:grid-cols-2 sm:mx-auto">
      @foreach(\App\Models\Store::where('active',1)->whereIn('id',[58,31])->get() as $store)
      <div>
        <div class="p-8 bg-base-300 rounded">
          <div class="mb-4 text-center">
            <p class="text-xl font-medium tracking-wide text-gray-900">
              {{$store->name}}
            </p>
            <div class="flex items-center justify-center">
              <p class="text-lg text-gray-500">{{ date('Y-m-d') }}</p>
            </div>
          </div>
        
          <a href="{{route('menu',[
            'menu' => base64_encode(serialize(['location'=>$store->id]))
            ])}}" class="inline-flex items-center justify-center w-full h-12 px-6 font-medium tracking-wide transition duration-200 btn btn-primary focus:shadow-outline focus:outline-none">
            {{__('Order Now')}}
          </a>
        </div>
        <div class="w-11/12 h-2 mx-auto bg-base-300 rounded-b opacity-75"></div>
        <div class="w-10/12 h-2 mx-auto bg-base-300 rounded-b opacity-50"></div>
        <div class="w-9/12 h-2 mx-auto bg-base-300 rounded-b opacity-25"></div>
      </div>
      @endforeach
    </div>
  </div>
</div>
    </main>


</x-app-layout>