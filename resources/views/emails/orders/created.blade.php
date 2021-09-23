@component('mail::message')
# Order

## Your order Confirmed!
## Hello, {{$order->user->name}} Your order has been confirmed. 
##
### Order Location: {{$order->store->name}}
### Order No: {{config('app.prefix')}}{{$order->no}}
### Payment: Stripe
### Order Date: {{$order->created_at}}

@component('mail::table')
| Menu Date   |      Product Name      |  Quantity |  Extraction Code |  Price |
|:------------|:----------------------:|-----------|----------|--------|
@foreach($items as $item)
|  {{date('Y-m-d',strtotime($item->menu_date))}} |  {{$item->product->title}} | {{$item->quantity}} | {{$item->extraction_code}} | {{$item->price}} |
@endforeach

@endcomponent

@component('mail::button', ['url' => config('app.url')])
View Detail
@endcomponent

Thank you for your order,<br>
{{ config('app.name') }}
@endcomponent
