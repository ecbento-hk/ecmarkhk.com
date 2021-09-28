<?php

use App\Models\Product\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // abort(404);
    return view('welcome');
})->name('welcome');

Route::get('/lang/{lang}', function ($lang) {
    // abort(404);
    if(array_key_exists($lang, Config::get('languages'))) {
        Session::put('applocale', $lang);
    }
    return back();
})->name('lang.switch');



Route::group(['prefix' => 'logistics', 'as' => 'logistics.'], function () {

    Route::get('/', 'LogisticsController@index')->name('home');
    Route::get('/store/{store}/machine', 'LogisticsController@machine')->name('machine');


    Route::get('/location/{location}/store', 'LogisticsController@store')->name('store');
    Route::get('/machine/{machine}/status', 'LogisticsController@status')->name('status');
    Route::get('/store/{store}/machine/{machine}/status', 'LogisticsController@machineStatus')->name('machine.status');
    Route::get('/login', 'LogisticsController@login')->name('login');
    Route::post('/login', 'LogisticsController@auth')->name('login');
    Route::get('/supplier', 'LogisticsController@supplier')->name('supplier');
    Route::post('/checkin', 'LogisticsController@checkin')->name('checkin');
    Route::get('/orders/loading', 'LogisticsController@loading')->name('loading');
    Route::get('/store/{store}/shelf', 'LogisticsController@shelf')->name('shelf');
    Route::any('/orders/extraction', 'LogisticsController@extraction')->name('extraction');
    Route::any('/buffer/extraction', 'LogisticsController@buffer_extraction')->name('buffer_extraction');
    Route::any('/track/{machineProduct}/delete', 'LogisticsController@trackDelete')->name('track.delete');
    Route::get('/{machine}/cell/{cell}/extraction/{action}', 'LogisticsController@action')->name('action');
    Route::get('/machine/{machine}/{orderClass}/create/{orderId}/{boxSize}/{warm?}', 'LogisticsController@create')->name('create');
    Route::post('/machine/{machine}/{orderClass}/auto-create/{store}/{product}/{boxSize}', 'LogisticsController@autoCreate')->name('auto-create');
    Route::post('/machine/{machine}/{orderClass}/create/{orderId}/{boxSize}/{warm?}', 'LogisticsController@create')->name('create');
    Route::get('/machine/{machine}/order/add/{orderId}/{boxSize}', 'LogisticsController@add')->name('add');
    Route::get('/sendFcmByStore/{store}', 'LogisticsController@sendFcmByStore')->name('sendFcmByStore');
});

// Route::get('/terms-and-conditions', function () {
//     // abort(404);
//     return view('terms_and_conditions');
// })->name('t&c');

Route::get('/bentos', function () {
    return view('bentos');
})->name('bentos');

Route::get('/about-us', function () {
    return view('pages.about');
})->name('about-us');



Route::get('/faqs', function () {
    return view('pages.faqs');
})->name('faqs');

Route::get('/terms-and-conditions', function () {
    return view('pages.terms_and_conditions');
})->name('t&c');

Route::get('/privacy-policy', function () {
    return view('pages.policy');
})->name('privacy-policy');

Route::get('/contact-us', function () {
    return view('pages.contact');
})->name('contact-us');

Route::get('/carts', function () {
    return view('carts');
})->name('carts');



Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/buffur', function () {
        // abort(404);
        if(date('Y-m-d H:i')>=date('Y-m-d H:i',strtotime('2021-09-07 12:00'))){
            return redirect()->route('welcome')->withErrors(['reminder'=>'Sorry, the pre-order time has passed. If you have any questions, please call our customer service hotline 96689069 for help.']);
        }
        return view('buffur');
    })->name('buffur');
    

    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');


    Route::get('/orders', function () {
        return redirect()->route('profile');
        return view('orders');
    })->name('orders');

    Route::get('/checkout', function () {
        return view('checkout');
    })->name('checkout');
 
    Route::get('/checkout/stripe', function () {

        // dd('redirect to mpgs');
        $stripe = new \Stripe\StripeClient(
            // 'sk_test_51JABlsBmpGYTwMtr7MtjIMpNFXXSkkbjjbfMuWECJ6IOHWOaSvXnptSQepBv38rJRxfrUaz03n8GUe7YqRpN5eK000vpVQghH0'
            'sk_live_DOnG2rKpmX3aipEdyCCWuaKC00gjeG2yB9'
        );
        $token = $stripe->tokens->create([
        'card' => [
            'number' => '4242424242424242',
            'exp_month' => 7,
            'exp_year' => 2022,
            'cvc' => '314',
        ],
        ]);
        // dd($token->id);
        
        $gateway = \Omnipay\Omnipay::create('Stripe');
        // $gateway->setApiKey('sk_test_51JABlsBmpGYTwMtr7MtjIMpNFXXSkkbjjbfMuWECJ6IOHWOaSvXnptSQepBv38rJRxfrUaz03n8GUe7YqRpN5eK000vpVQghH0');
        // $gateway->setApiKey('sk_test_UE3xmTh2owaSc94Adn91xJOx00ES1c7uqG');
        $gateway->setApiKey('sk_live_DOnG2rKpmX3aipEdyCCWuaKC00gjeG2yB9');

        $response = $gateway->purchase(array('amount' => '10.00', 'currency' => 'USD', 'token' => $token->id))->send();

        if ($response->isRedirect()) {
            // redirect to offsite payment gateway
            $response->redirect();
        } elseif ($response->isSuccessful()) {
            // payment was successful: update database
            dd($response);
        } else {
            // payment failed: display message to customer
            dd($response->getMessage());
        }

    })->name('checkout.stripe');
});


Route::get('/images/product/{slug}', function ($slug) {
    $product = Product::where('slug', $slug)->first();
    if($product->media){
        $img = \Intervention\Image\ImageManagerStatic::make(storage_path('app/public/'.$product->media->file_path));
    } else {
        $img = \Intervention\Image\ImageManagerStatic::make($product->image_file);
    }
    $img->fit(500, 500, function ($constraint) {
        $constraint->upsize();
    });     
    return $img->response();
})->name('images.product');

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
