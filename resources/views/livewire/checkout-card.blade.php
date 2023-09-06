<div>
<style>/* Variables */
* {
  box-sizing: border-box;
}

body {
  font-family: -apple-system, BlinkMacSystemFont, sans-serif;
  font-size: 16px;
  -webkit-font-smoothing: antialiased;
  display: flex;
  justify-content: center;
  align-content: center;
  height: 100vh;
  width: 100vw;
}

form {
  width: 30vw;
  min-width: 500px;
  align-self: center;
  box-shadow: 0px 0px 0px 0.5px rgba(50, 50, 93, 0.1),
    0px 2px 5px 0px rgba(50, 50, 93, 0.1), 0px 1px 1.5px 0px rgba(0, 0, 0, 0.07);
  border-radius: 7px;
  padding: 40px;
}

.hidden {
  display: none;
}

#payment-message {
  color: rgb(105, 115, 134);
  font-size: 16px;
  line-height: 20px;
  padding-top: 12px;
  text-align: center;
}

#payment-element {
  margin-bottom: 24px;
}

/* Buttons and links */
button {
  background: #5469d4;
  font-family: Arial, sans-serif;
  color: #ffffff;
  border-radius: 4px;
  border: 0;
  padding: 12px 16px;
  font-size: 16px;
  font-weight: 600;
  cursor: pointer;
  display: block;
  transition: all 0.2s ease;
  box-shadow: 0px 4px 5.5px 0px rgba(0, 0, 0, 0.07);
  width: 100%;
}
button:hover {
  filter: contrast(115%);
}
button:disabled {
  opacity: 0.5;
  cursor: default;
}

/* spinner/processing state, errors */
.spinner,
.spinner:before,
.spinner:after {
  border-radius: 50%;
}
.spinner {
  color: #ffffff;
  font-size: 22px;
  text-indent: -99999px;
  margin: 0px auto;
  position: relative;
  width: 20px;
  height: 20px;
  box-shadow: inset 0 0 0 2px;
  -webkit-transform: translateZ(0);
  -ms-transform: translateZ(0);
  transform: translateZ(0);
}
.spinner:before,
.spinner:after {
  position: absolute;
  content: "";
}
.spinner:before {
  width: 10.4px;
  height: 20.4px;
  background: #5469d4;
  border-radius: 20.4px 0 0 20.4px;
  top: -0.2px;
  left: -0.2px;
  -webkit-transform-origin: 10.4px 10.2px;
  transform-origin: 10.4px 10.2px;
  -webkit-animation: loading 2s infinite ease 1.5s;
  animation: loading 2s infinite ease 1.5s;
}
.spinner:after {
  width: 10.4px;
  height: 10.2px;
  background: #5469d4;
  border-radius: 0 10.2px 10.2px 0;
  top: -0.1px;
  left: 10.2px;
  -webkit-transform-origin: 0px 10.2px;
  transform-origin: 0px 10.2px;
  -webkit-animation: loading 2s infinite ease;
  animation: loading 2s infinite ease;
}

@-webkit-keyframes loading {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes loading {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}

@media only screen and (max-width: 600px) {
  form {
    width: 80vw;
    min-width: initial;
  }
}</style>
  <h3 class="text-2xl">Your Cart</h3>
  <hr class="pb-6 mt-6">
  <table class="w-full text-sm lg:text-base" cellspacing="0">
    <thead>
      <tr class="h-12 uppercase">
        <th class="hidden md:table-cell text-left">Picture</th>
        <th class="text-left">Product</th>
        <th class="lg:text-right text-left pl-5 lg:pl-0">
          <span class="lg:hidden" title="Quantity">QTY</span>
          <span class="hidden lg:inline">QTY</span>
        </th>
        <th class="hidden text-right md:table-cell">Price</th>
        <th class="text-right">Total</th>
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
            <p class="mb-2">Menu Date: <code>{{date('Y-m-d',strtotime($item->menu_date))}}</code></p>
            <p class="mb-2">Remark: {{$item->remark}}</p>
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
  <h3 class="text-2xl">Checkout Now</h3>
  <form wire:submit.prevent="submit">
    <div class="my-4 mt-6 -mx-2 lg:flex text-sm">
      
      <div class="lg:px-2 lg:w-1/2">

      @if(count($coupons))
      <!-- <div class="lg:px-2 lg:w-1/2"> -->
        <div class="p-4 bg-base-300 rounded-lg">
          <h1 class="ml-2 font-bold uppercase">Coupon Code</h1>
        </div>
        <div class="p-4">
          <p class="mb-4 italic">If you have a coupon code, please enter it in the box below</p>
          <div class="grid grid-cols-4 gap-4">
            @foreach ($coupons as $coupon)
            <div wire:click="$emit('coupon_choosed','{{$coupon->id}}')" class="{{ ($selected_coupon==$coupon->id)?'bg-primary text-white':'bg-gray-300 text-gray-400' }} text-center text-md cursor-pointer hover:shadow-lg shadow-md font-bold p-2 rounded-lg">
              ${{$coupon->value > 0 ? $coupon->value :$coupon->coupon->value}}
            </div>
            @endforeach
          </div>
        </div>

        
      <!-- </div> -->
      @endif

        <div class="p-4 bg-base-300 rounded-lg">
          <h1 class="ml-2 font-bold uppercase">Payment Method</h1>
        </div>
        <div class="p-4">
          <p class="mb-4 italic">Please choose a payment method to pay your order.</p>

          <div class="alert alert-success my-6">
            <div class="flex-1">
              <svg class="w-6 h-6 mx-2 stroke-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
              </svg>
              <label>{{__('Due to the system update of the third-party payment gateway, customers need to input credit card detail again.')}}</label>
            </div>
          </div>

          @php
          $userCards = auth()->user()->payments()->where(['brand'=>'STRIPE'])->get();
          @endphp
          <div class="grid grid-cols-3 grid-rows-3 gap-4">
            @if(count($userCards)>0)
              @foreach ($payments as $payment)
              <div wire:click="$emit('payment_method','{{$payment->code}}')" class="{{ ($selected_payment==$payment->code)?'bg-primary text-white':'bg-gray-100 text-gray-400' }} text-center text-md cursor-pointer hover:shadow-lg shadow-md font-bold p-2 rounded-lg">
                <!-- {{$payment->title}} -->
                Credit Card
              </div>
              @endforeach
            @endif

            <div wire:click="$emit('payment_method','new')" class="{{ ($selected_payment=='new')?'bg-primary text-white':'bg-gray-100 text-gray-400' }} text-center text-md cursor-pointer hover:shadow-lg shadow-md font-bold p-2 rounded-lg">
              New Credit Cards
            </div>

          </div>


        </div>
        <div class="@if($selected_payment !== 'new') hidden @endif">
          <div class="p-4 mt-6 bg-base-300 rounded-lg">
            <h1 class="ml-2 font-bold uppercase">New Credit Card : {{ $number }}</h1>
          </div>
          <div class="p-4 grid grid-cols-3 gap-4">
            <input id="cc" type="text" x-data="$('#cc').inputmask('9999-9999-9999-9999');" class="col-span-3" wire:model="number" placeholder="Card Number">
            <select wire:model="exp_month" placeholder="exp_month">
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
            <select wire:model="exp_year" placeholder="exp_year">
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
            <input type="text" id="cvc" x-data="$('#cvc').inputmask('999');" wire:model="cvc" placeholder="cvc">
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
          <h1 class="ml-2 font-bold uppercase">Choose Your Card</h1>
        </div>
        <div class="p-4 grid grid-cols-3 gap-4">
          @foreach($userCards as $card)
          <!-- <div wire:click="updateCardPayment('{{$card->id}}')" class="{{ ($selected_card==$card->id) ? 'bg-primary text-white':'bg-gray-300 text-gray-400' }} text-center text-md cursor-pointer hover:shadow-lg shadow-md font-bold p-2 rounded-lg">
            {{$card->name}}
          </div> -->

          <div class="shadow stats cursor-pointer">
            <div wire:click="updateCardPayment('{{$card->id}}')" class="{{ ($selected_card==$card->id) ? 'bg-primary text-white':'bg-gray-100 text-gray-400' }} stat">
              <div class="stat-title">Credit Card</div> 
              <div class="stat-value">{{substr($card->name, -4)}}</div> 
              <div class="stat-desc">Last 4 Characters</div>
            </div>
          </div>


          @endforeach
        </div>

        @endif
      </div>

      <div class="lg:px-2 lg:w-1/2">


        <div class="p-4 bg-base-300 rounded-lg">
          <h1 class="ml-2 font-bold uppercase">Order Details</h1>
        </div>
        <div class="p-4 mb-64">
          <p class="mb-6 italic">Shipping and additionnal costs are calculated based on values you have entered</p>

          <div class="flex justify-between border-b">
            <div class="lg:px-4 lg:py-2 m-2 font-bold text-center text-gray-800">
              Subtotal
            </div>
            <div class="lg:px-4 lg:py-2 m-2 font-bold text-center text-gray-900">
              ${{$cartItems->sum('amount')}}
            </div>
          </div>
          <div class="flex justify-between border-b">
            <div class="lg:px-4 lg:py-2 m-2 font-bold text-center text-gray-800">
              Discount
            </div>
            <div class="lg:px-4 lg:py-2 m-2 font-bold text-center text-gray-900">
              ${{0}}
            </div>
          </div>
          <div class="flex justify-between border-b">
            <div class="lg:px-4 lg:py-2 m-2 font-bold text-center text-gray-800">
              Coupon
            </div>
            <div class="lg:px-4 lg:py-2 m-2 font-bold text-center text-gray-900">
              ${{$selected_coupon_price}}
            </div>
          </div>
          <div class="flex justify-between border-b">
            <div class="lg:px-4 lg:py-2 m-2 font-bold text-center text-gray-800">
              Shipping
            </div>
            <div class="lg:px-4 lg:py-2 m-2 font-bold text-center text-gray-900">
              ${{0}}
            </div>
          </div>


          <div class="flex justify-between pt-4 border-b">
            <div class="lg:px-4 lg:py-2 m-2 font-bold text-center text-gray-800">
              Total
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
              }} wire:loading.class="loading" class="flex justify-center w-full mt-6 font-medium uppercase btn btn-primary rounded-lg">
            <span class="ml-2 mt-5px text-xl" wire:loading.remove>{{ $procced }}</span>
            <span class="ml-2 mt-5px text-xl hidden" wire:loading.class.remove="hidden">Loading</span>
          </button>

        </div>
      </div>

    </div>
  </form>
  @endif
  <script src="https://js.stripe.com/v3/"></script>

  <!-- Display a payment form -->
  <form id="payment-form">
      <div id="link-authentication-element">
        <!--Stripe.js injects the Link Authentication Element-->
      </div>
      <div id="payment-element">
        <!--Stripe.js injects the Payment Element-->
      </div>
      <button id="submit">
        <div class="spinner hidden" id="spinner"></div>
        <span id="button-text">Pay now</span>
      </button>
      <div id="payment-message" class="hidden"></div>
  </form><script>// This is your test publishable API key.
const stripe = Stripe("pk_test_51NET0SGiBONmYgRKVDVIKL5HBnOWLVrqdSZIOPna6YWYQyDQ1Fwhm28zbM3SY5o4VeFmBQufouoksO8TWp2ExuZO00gdyY2yLo");

// The items the customer wants to buy
const items = [{ id: "xl-tshirt" }];

let elements;

initialize();
checkStatus();

document
  .querySelector("#payment-form")
  .addEventListener("submit", handleSubmit);

let emailAddress = '';
// Fetches a payment intent and captures the client secret
async function initialize() {
  const { clientSecret } = await fetch("/create.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ items }),
  }).then((r) => r.json());

  elements = stripe.elements({ clientSecret });

  const linkAuthenticationElement = elements.create("linkAuthentication");
  linkAuthenticationElement.mount("#link-authentication-element");

  const paymentElementOptions = {
    layout: "tabs",
  };

  const paymentElement = elements.create("payment", paymentElementOptions);
  paymentElement.mount("#payment-element");
}

async function handleSubmit(e) {
  e.preventDefault();
  setLoading(true);

  const { error } = await stripe.confirmPayment({
    elements,
    confirmParams: {
      // Make sure to change this to your payment completion page
      return_url: "http://localhost:4242/checkout.html",
      receipt_email: emailAddress,
    },
  });

  // This point will only be reached if there is an immediate error when
  // confirming the payment. Otherwise, your customer will be redirected to
  // your `return_url`. For some payment methods like iDEAL, your customer will
  // be redirected to an intermediate site first to authorize the payment, then
  // redirected to the `return_url`.
  if (error.type === "card_error" || error.type === "validation_error") {
    showMessage(error.message);
  } else {
    showMessage("An unexpected error occurred.");
  }

  setLoading(false);
}

// Fetches the payment intent status after payment submission
async function checkStatus() {
  const clientSecret = new URLSearchParams(window.location.search).get(
    "payment_intent_client_secret"
  );

  if (!clientSecret) {
    return;
  }

  const { paymentIntent } = await stripe.retrievePaymentIntent(clientSecret);

  switch (paymentIntent.status) {
    case "succeeded":
      showMessage("Payment succeeded!");
      break;
    case "processing":
      showMessage("Your payment is processing.");
      break;
    case "requires_payment_method":
      showMessage("Your payment was not successful, please try again.");
      break;
    default:
      showMessage("Something went wrong.");
      break;
  }
}

// ------- UI helpers -------

function showMessage(messageText) {
  const messageContainer = document.querySelector("#payment-message");

  messageContainer.classList.remove("hidden");
  messageContainer.textContent = messageText;

  setTimeout(function () {
    messageContainer.classList.add("hidden");
    messageContainer.textContent = "";
  }, 4000);
}

// Show a spinner on payment submission
function setLoading(isLoading) {
  if (isLoading) {
    // Disable the button and show a spinner
    document.querySelector("#submit").disabled = true;
    document.querySelector("#spinner").classList.remove("hidden");
    document.querySelector("#button-text").classList.add("hidden");
  } else {
    document.querySelector("#submit").disabled = false;
    document.querySelector("#spinner").classList.add("hidden");
    document.querySelector("#button-text").classList.remove("hidden");
  }
}</script>
</div>