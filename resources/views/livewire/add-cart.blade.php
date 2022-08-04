{{-- <x-jet-dialog-modal wire:model="addingToCart" maxWidth="7xl">

  <x-slot name="title">
      {{__('Product Detail')}}
</x-slot>

<x-slot name="content">

  <div class="flex h-56">
    <div class="w-1/3 bg-cover bg-center" style="background-image: url('{{$image}}')">
    </div>
    <div class="w-2/3 p-4 pt-0">
      <h2 class="text-sm title-font text-gray-500 tracking-widest">BRAND NAME</h2>
      <h1 class="text-gray-900 font-bold text-2xl">{{$title}}</h1>
      <p class="mt-2 text-gray-600 text-sm">{{$description}}</p>
      <p class="mt-2 text-gray-600 text-sm">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
      <p>
        <x-input.quantity wire:model="quantity" />
      </p>
      <div class="relative">
        <select wire:model="quantity" class="rounded border appearance-none border-gray-300 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 text-base pl-3 pr-10 w-40 mt-4">
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
          <option>6</option>
          <option>7</option>
          <option>8</option>
          <option>9</option>
        </select>


      </div>
    </div>
  </div>
</x-slot>

<x-slot name="footer">
  <div class="flex item-center justify-between">
    <h1 class="text-gray-700 font-bold text-3xl pt-2">${{$price}}</h1>
    <button wire:click="addToCart()" class="px-3 py-2 btn btn-primary font-bold uppercase rounded">{{__('Add to Cart')}}</button>
  </div>

</x-slot>

</x-jet-dialog-modal> --}}
<x-jet-dialog-modal wire:model="addingToCart" maxWidth="5xl">
  <x-slot name="title">
  </x-slot>
  <x-slot name="content">
    @if($product)
    <section class="text-gray-600 bg-base-200 body-font overflow-hidden">
      <div class="container mx-auto">
        <div class="lg:w-5/5 mx-auto flex flex-wrap">
          <img alt="ecommerce" class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded" src="{{$image}}">
          <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
            <h2 class="text-sm title-font text-gray-500 tracking-widest">{{$product->brand->name}}</h2>
            <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{$title}}</h1>
            <div class="flex mb-4">
              Menu Date: <code style="color:red">{{$menu_product_date}}</code>
            </div>
            <p class="leading-relaxed">{{$description}}</p>
            <div class="flex mt-6 items-center">
              <div class="flex items-center">
                <span class="mr-3">{{__('Quantity')}}</span>
                <x-input.quantity wire:model="quantity" />
              </div>
            </div>
            <div class="w-full flex mt-6 items-center pb-5 border-b-2 border-base-300 mb-5">
              <div class="flex items-center justify-start">
                <span class="mr-4">{{__('Student')}}</span>
                <div class="relative">

                  <select wire:model="remark" required class="select pl-3 pr-10">
                    <option>---</option>
                    @if(count($students))
                    @foreach($students as $student)

                      @php 
                      $ordered = \App\Models\CartItem::where([
                        'user_id'=> auth()->user()->id,
                        'menu_date' => $menu_product_date,
                        ])->where('remark','like','%'.$student.'%')->exists();
                      @endphp
                    <option {{$ordered?'disabled':''}}>{{$student. ($ordered?'  ***Added':'') }}</del></option>
                    
                    @endforeach
                    @endif
                    <option>New Student</option>
                  </select>
                  <span class=" right-0 top-0 h-full w-10 text-center text-gray-600 pointer-events-none flex items-center justify-center">
                  </span>
                </div>
              </div>
            </div>
            <div class="{{ $disabledRemark ? 'hidden' : '' }}">
            <!-- <div class="text-red-400 w-full text-left text-gray-600 pointer-events-none flex ">
              Class - Name
            </div> -->
            <div class="w-full flex mt-6 items-center pb-5 border-b-2 border-base-300 mb-5">
          
            
             <div class="flex items-center justify-start">  
              <span class="mr-10">{{__('New')}}</span>
              <div class="relative">
                  <select id="new_student_class" class="select mb-3" wire:model.defer="student.class" placeholder="Class">
                    <option value="">----</option>
                    <optgroup label="PG">
                      <option value="PG1B-1">PG1B-1</option>
                      <option value="PG1A-1">PG1A-1</option>
                      <option value="PG1A-2">PG1A-2</option>
                    </optgroup>
                    <optgroup label="1-6">
                      <option value="1-1">1-1</option>
                      <option value="1-2">1-2</option>
                      <option value="1-3">1-3</option>
                      <option value="2-1">2-1</option>
                      <option value="2-2">2-2</option>
                      <option value="2-3">2-3</option>
                      <option value="3-1">3-1</option>
                      <option value="3-2">3-2</option>
                      <option value="3-3">3-3</option>
                      <option value="3-4">3-4</option>
                      <option value="4-1">4-1</option>
                      <option value="4-2">4-2</option>
                      <option value="4-3">4-3</option>
                      <option value="4-4">4-4</option>
                      <option value="5-1">5-1</option>
                      <option value="5-2">5-2</option>
                      <option value="5-3">5-3</option>
                      <option value="5-4">5-4</option>
                      <option value="6-1">6-1</option>
                      <option value="6-2">6-2</option>
                      <option value="6-3">6-3</option>
                      <option value="6-4">6-4</option>
                    </optgroup>
                  <optgroup label="7-8">
                    <option value="7-1">7-1</option>
                    <option value="7-2">7-2</option>
                    <option value="7-3">7-3</option>
                    <option value="7-4">7-4</option>
                    <option value="8-1">8-1</option>
                    <option value="8-2">8-2</option>
                    <option value="8-3">8-3</option>
                    <option value="8-4">8-4</option>
                  </optgroup>
                  <optgroup label="9-12">
                    <option value="9-1">9-1</option>
                    <option value="9-2">9-2</option>
                    <option value="9-3">9-3</option>
                    <option value="9-4">9-4</option>
                    <option value="10-1">10-1</option>
                    <option value="10-2">10-2</option>
                    <option value="10-3">10-3</option>
                    <option value="10-4">10-4</option>
                    <option value="11-1">11-1</option>
                    <option value="11-2">11-2</option>
                    <option value="11-3">11-3</option>
                    <option value="11-4">11-4</option>
                    <option value="12-1">12-1</option>
                    <option value="12-2">12-2</option>
                    <option value="12-3">12-3</option>
                    <option value="12-4">12-4</option>
                    <option value="12-5">12-5</option>
                  </optgroup>
                  <optgroup label="Staff">
                    <option value="Staff Grade 4-6">Staff Grade 1-3</option>
                    <option value="Staff Grade 4-6">Staff Grade 4-6</option>
                    <option value="Staff Grade 7-8">Staff Grade 7-8</option>
                    <option value="Staff Grade 9 -12">Staff Grade 9 -12</option>
                    <option value="Head Office Staff Front Desk">Head Office Staff Front Desk</option>
                  </optgroup>
                  </select>
                  {{-- <input type="text" id="new_student_class" class="input mb-3" wire:model.defer="student.class" placeholder="Class"> --}}
                  <input type="text" id="new_student_name"  class="input" wire:model.defer="student.name" placeholder="Name">
                 
              </div>
            </div>
          </div>
          
            <script>
              $('#new_student').on('change',function(){
                @this.new_student =$('#new_student').val();
              });
            </script>
            </div>
  

          @if(session()->has('message'))
          <div class="alert alert-error mt-6 mb-6">
            <div class="flex">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mx-2 stroke-current">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
              </svg>
              <label>{{ session('message') }}</label>
            </div>
          </div>

          @endif


          
            <div class="flex">
              <span class="title-font font-bold text-2xl py-2 pr-6 text-gray-900">${{$price}}</span>
              <button {{ $disabledButton ? 'disabled' : '' }} wire:click="addToCart()" class="flex ml-auto text-white btn-primary btn border-0 py-2 px-6 mr-3 focus:outline-none">{{__('Add To Cart')}}</button>
              <button wire:click="$set('addingToCart',false)" class="px-3 py-2 btn btn-outline btn-secondary font-bold uppercase rounded-lg">{{__('Close')}}</button>
            </div>



          </div>
        </div>
      </div>
    </section>
    @endif
  </x-slot>
  <x-slot name="footer">
    <!-- <div class="w-full flex item-center justify-between">
          <h1 class="text-gray-700 font-bold text-3xl pt-2">${{$price}}</h1>
    </div>  -->
  </x-slot>
</x-jet-dialog-modal>