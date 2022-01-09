<div class="mb-16">

  <h3 class="text-2xl">{{__('Your Cart')}}</h3>
  <hr class="pb-6 mt-6">
  <table class="w-full text-sm lg:text-base" cellspacing="0">
    <thead>
      <tr class="h-12 uppercase">
        <th class="hidden md:table-cell text-left">{{__('Picture')}}</th>
        <th class="text-left">{{__('Product')}}</th>
        <th class="lg:text-right text-left pl-5 lg:pl-0">
          <span class="lg:hidden" title="Quantity">{{__('QTY')}}</span>
          <span class="hidden lg:inline">{{__('QTY')}}</span>
        </th>
        <th class="hidden text-right md:table-cell">{{__('Price')}}</th>
        <th class="text-right">{{__('Total')}}</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($cartItems->sortBy('menu_date') as $item)
      <tr>
        <td class="hidden pb-4 md:table-cell text-center">
          <a href="#">
            <img src="{{$item->product->image_file?$item->product->image_file:'https://www.kenyons.com/wp-content/uploads/2017/04/default-image-620x600.jpg'}}" class="w-20 h-14 object-cover rounded-box" alt="Thumbnail">
          </a>
        </td>
        <td>
          <a href="#">
            <p class="mb-2">{{$item->product->title}}</p>
            <p class="mb-2">{{__('Menu Date')}}: <code>{{date('Y-m-d',strtotime($item->menu_date))}}</code></p>
            <p class="mb-2">Period: {{$item->period->title}}</p>
            <button wire:click="removeItem({{$item->id}})" type="submit" class="text-gray-700 mb-5">
              <small class="text-red-500 text-xs"><u>{{__('Remove item')}}</u></small>
            </button>
          </a>
        </td>
        <td class="justify-center md:justify-end md:flex mt-6">
          <div class="w-20 h-10">
            <div class="relative flex flex-row w-full h-5 text-center">
              <input type="number" disabled value="{{$item->quantity}}" class="text-sm text-center w-full font-semibold text-center text-gray-700 bg-gray-200 outline-none focus:outline-none hover:text-black focus:text-black" />
            </div>
          </div>
        </td>
        <td class="hidden text-right md:table-cell">
          <span class="text-sm lg:text-base font-medium">
            ${{$item->price}}
          </span>
        </td>
        <td class="text-right">
          <span class="text-sm lg:text-base font-medium">
            ${{$item->amount}}
          </span>
        </td>
      </tr>
      @endforeach
      @if(count($cartItems)<=0) <tr>
        <td colspan="5" class="text-center p-6">
          <div class="p-6 h-screen">
            <h3>No Data.</h3>
            <a href="{{route('welcome')}}" class="mt-3 btn btn-primary rounded-lg">
              Shopping Now
            </a>
          </div>
        </td>
        </tr>
        @endif
    </tbody>
  </table>
  @if(count($cartItems)>0)

  <hr class="pb-6 mt-6">
  <h3 class="text-2xl">{{__('Checkout Now')}}</h3>
  <form wire:submit.prevent="submit">
    <div class="my-4 mt-6 -mx-2 mb-6 lg:mb-0 lg:flex text-sm">

      <div class="lg:px-2 lg:w-1/2">
        <div class="p-4 bg-base-300 rounded-lg">
          <h1 class="ml-2 font-bold uppercase">{{__('Payment Method')}}</h1>
        </div>
        <div class="p-4">
          <p class="mb-4 italic">{{__('Please choose a payment method to pay your order.')}}</p>
          @php
          $userCards = auth()->user()->payments()->where(['brand'=>'STRIPE'])->get();
          @endphp
          <div class="grid grid-cols-3 grid-rows-3 gap-4">
            @if(count($userCards)>0)
            @foreach ($payments as $payment)
            <div wire:click="$emit('payment_method','{{$payment->code}}')" class="{{ ($selected_payment==$payment->code)?'bg-primary text-white':'bg-gray-100 text-gray-400' }} text-center text-md cursor-pointer hover:shadow-lg shadow-md font-bold p-2 rounded-lg">
              <!-- {{$payment->title}} -->
              {{__('Credit Card')}}
            </div>
            @endforeach
            @endif

            <div wire:click="$emit('payment_method','new')" class="{{ ($selected_payment=='new')?'bg-primary text-white':'bg-gray-100 text-gray-400' }} text-center text-md cursor-pointer hover:shadow-lg shadow-md font-bold p-2 rounded-lg">
            {{__('New Credit Cards')}}
            </div>

          </div>


        </div>
        <div class="@if($selected_payment !== 'new') hidden @endif">
          <div class="p-4 mt-6 bg-base-300 rounded-lg">
            <h1 class="ml-2 font-bold uppercase">New Credit Card : {{ $number }}</h1>
          </div>
          <div class="p-4 grid grid-cols-3 gap-4">
            <input id="cc" type="text" x-data="$('#cc').inputmask('9999-9999-9999-9999');" class="col-span-3" wire:model="number" placeholder="Card Number">
            <select wire:model.defer="exp_month" placeholder="exp_month">
              <option value="MM">MM</option>
              <option value="01">01</option>
              <option value="02">02</option>
              <option value="03">03</option>
              <option value="04">04</option>
              <option value="05">05</option>
              <option value="06">06</option>
              <option value="07">07</option>
              <option value="08">08</option>
              <option value="09">09</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
            </select>
            <select wire:model.defer="exp_year" placeholder="exp_year">
              <option value="YYYY">YYYY</option>
              <option value="2021">2021</option>
              <option value="2022">2022</option>
              <option value="2023">2023</option>
              <option value="2024">2024</option>
              <option value="2025">2025</option>
              <option value="2026">2026</option>
              <option value="2027">2027</option>
              <option value="2028">2028</option>
              <option value="2029">2029</option>
              <option value="2030">2030</option>
              <option value="2031">2031</option>
              <option value="2032">2032</option>
              <option value="2033">2033</option>
              <option value="2034">2034</option>
              <option value="2035">2035</option>
              <option value="2036">2036</option>
              <option value="2037">2037</option>
              <option value="2038">2038</option>
              <option value="2039">2039</option>
              <option value="2040">2040</option>
            </select>
            <input type="text" id="cvc" x-data="$('#cvc').inputmask('999');" wire:model..defer="cvc" placeholder="cvc">
          </div>

          <script>
            $('#cc').on('change', function() {
              @this.number = $('#cc').val();
            });
            $('#cvc').on('change', function() {
              @this.cvc = $('#cvc').val();
            });
          </script>

        </div>

        @if($selected_payment == 'stripe')
        <div class="p-4 mt-6 bg-base-300 rounded-lg">
          <h1 class="ml-2 font-bold uppercase">{{__('Choose Your Card')}}</h1>
        </div>
        <div class="p-4 grid grid-cols-3 gap-4">
          @foreach($userCards as $card)
          <!-- <div wire:click="updateCardPayment('{{$card->id}}')" class="{{ ($selected_card==$card->id) ? 'bg-primary text-white':'bg-gray-300 text-gray-400' }} text-center text-md cursor-pointer hover:shadow-lg shadow-md font-bold p-2 rounded-lg">
            {{$card->name}}
          </div> -->

          <div class="shadow stats cursor-pointer">
            <div wire:click="updateCardPayment('{{$card->id}}')" class="{{ ($selected_card==$card->id) ? 'bg-primary text-white':'bg-gray-100 text-gray-400' }} stat">
              <div class="stat-title">{{__('Credit Card')}}</div> 
              <div class="stat-value">{{substr($card->name, -4)}}</div> 
              <div class="stat-desc">{{__('Last 4 Characters')}}</div>
            </div>
          </div>


          @endforeach
        </div>

        @endif
      </div>

      <div class="lg:px-2 lg:w-1/2">


        <div class="p-4 bg-base-300 rounded-lg">
          <h1 class="ml-2 font-bold uppercase">{{__('Order Details')}}</h1>
        </div>
        <div class="p-4">
          <p class="mb-6 italic">
        {{__('Please pick up your order after 11:00am')}} <br>
        {{__('For food safety reason, please consume your order within 2 Hours')}}
          </p>
          <div class="flex justify-between border-b">
            <div class="lg:px-4 lg:py-2 m-2 font-bold text-center text-gray-800">
              {{__('Subtotal')}}
            </div>
            <div class="lg:px-4 lg:py-2 m-2 font-bold text-center text-gray-900">
              ${{$cartItems->sum('amount')}}
            </div>
          </div>
          <div class="flex justify-between border-b">
            <div class="lg:px-4 lg:py-2 m-2 font-bold text-center text-gray-800">
              {{__('Discount')}}
            </div>
            <div class="lg:px-4 lg:py-2 m-2 font-bold text-center text-gray-900">
              ${{0}}
            </div>
          </div>
          <div class="flex justify-between border-b">
            <div class="lg:px-4 lg:py-2 m-2 font-bold text-center text-gray-800">
              {{__('Coupon')}}
            </div>
            <div class="lg:px-4 lg:py-2 m-2 font-bold text-center text-gray-900">
              ${{$selected_coupon_price}}
            </div>
          </div>
          <div class="flex justify-between border-b">
            <div class="lg:px-4 lg:py-2 m-2 font-bold text-center text-gray-800">
              {{__('Shipping')}}
            </div>
            <div class="lg:px-4 lg:py-2 m-2 font-bold text-center text-gray-900">
              ${{0}}
            </div>
          </div>


          <div class="flex justify-between pt-4 border-b">
            <div class="lg:px-4 lg:py-2 m-2 font-bold text-center text-gray-800">
              {{__('Total')}}
            </div>
            <div class="lg:px-4 lg:py-2 m-2 font-bold text-center text-gray-900">
              ${{ ($cartItems->sum('amount') - $selected_coupon_price) <=0 ? 0 : $cartItems->sum('amount') - $selected_coupon_price }}
            </div>
          </div>


          @if(session()->has('message'))
          <div class="alert alert-error mt-6">
            <div class="flex-1">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mx-2 stroke-current">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
              </svg>
              <label>{{ session('message') }}</label>
            </div>
          </div>
        

          @endif


          <button {{
                $done==true ?'type="submit"':'disabled'
              }} wire:loading.class="loading" class="flex justify-center w-full mt-6 mb-16 md:mb-0 font-medium uppercase btn btn-primary rounded-lg">
            <span class="ml-2 mt-5px text-xl" wire:loading.remove>{{ __($procced) }}</span>
            <span class="ml-2 mt-5px text-xl hidden" wire:loading.class.remove="hidden">{{__('Loading')}}</span>
          </button>

        </div>
      </div>

    </div>
  </form>
  @endif
</div>