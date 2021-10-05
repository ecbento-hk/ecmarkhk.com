<?php

namespace App\Models\Order;

use App\Http\Api\V1\Model\Product\Product;
use Illuminate\Database\Eloquent\Model;
use App\Classes\SMS;
use App\Http\Api\V1\Model\Device\DeviceOrder;
use App\Http\Api\V1\Model\Payment;
use OptimistDigital\NovaNotesField\Traits\HasNotes;
use App\OrderRefund;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\Product\Menu;
use App\Models\Product\MenuLocationStock;
use App\Models\User;

class OrderItem extends Model
{
    // use HasNotes, LogsActivity;
    public $guarded = [];

    //REMIND:status, refund_status
    protected $casts = [
        'extracted' => 'boolean',
        'extraction_start' => 'datetime',
        'extraction_expired' => 'datetime',
        'refunded_at' => 'datetime',
        'ship_data' => 'json',
        'menu_date' => 'date'
    ];

    protected $dates = [
        'extraction_start',
        'extraction_expired',
        'refunded_at',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function store()
    {
        return $this->belongsTo(\App\Models\Store::class);
    }
    public function machine()
    {
        return $this->belongsTo(\App\Models\Store::class);
    }

    public function productSku()
    {
        return $this->belongsTo(\App\Models\Product\ProductSku::class);
    }

    public function product()
    {
        return $this->belongsTo(\App\Models\Product\Product::class);
    }

    public function supplier()
    {
        return $this->product()->brand_id;
    }

    protected static function boot()
    {
        parent::boot();


        static::creating(function ($model) {
            // Create default sku 
            // if ($model->status == 'paid') {
            //     $menu = Menu::find($model->remark);
            //     // $menu = $model->remark; //remark == menu_id

            //     if ($menu) {
            //         $menuProduct = MenuLocationStock::where([
            //             'menu_id' => $menu,
            //             'store_id' => $model->store_id,
            //             'product_id' => $model->product_id,
            //         ])->first();

            //         $total = OrderItem::where([
            //             'product_id' => $model->product_id,
            //             'menu_date' => $model->menu_date,
            //             'store_id' => $model->store_id,
            //             'period' => $model->period,
            //             'status' => 'paid'
            //         ])->sum('quantity');

            //         // dd($menuProduct);
            //         // remindAdmin('有人落order:#'.$model->product_id.' x'.$total);

            //         if($menuProduct){
            //             $menuProduct->update([
            //                 'sold' => $total,
            //             ]);  
            //         }

            //     }
            // }
            // remindAdmin('有人落order:#'.Product::find($model->product_id)->title.' x'.$model->status);

        });
        static::updated(function ($model) {
            // Create default sku 
            // remindAdmin('有人落order:#'.$model->product_id.'x1, status:'.$model->status);

            if ($model->status == 'paid') {
                $menu = Menu::find($model->remark);
                // $menu = $model->remark; //remark == menu_id
                // dd($menu);
                if ($menu) {
                    $menuProduct = MenuLocationStock::where([
                        'menu_id' => $menu,
                        'store_id' => $model->store_id,
                        'product_id' => $model->product_id,
                    ])->first();

                    $total = OrderItem::where([
                        'product_id' => $model->product_id,
                        'menu_date' => $model->menu_date,
                        'store_id' => $model->store_id,
                        'period' => $model->period,
                        'status' => 'paid'
                    ])->sum('quantity');

                    // dd($menuProduct);
                    // remindAdmin('有人落order:#'.$model->product_id.' x'.$total);

                    if($menuProduct){
                        $menuProduct->update([
                            'sold' => $total,
                        ]);  
                    }

                }
            }
        });
    }

    public function setShipStatusAttribute($value)
    {
        if ($this->order_id > 200000) {
            // fcm_remind($value, $this->order_id, $this->product);
        }

        $this->attributes['ship_status'] = $value;
    }

    public function setStatusAttribute($value)
    {
        // switch ($value) {
        //     case 'request_refund':
        //         //Create Order refund record
        //         OrderRefund::create([
        //             'order_id' => $this->attributes['order_id'],
        //             'order_item_id' => $this->attributes['id'],
        //             'user_id' => $this->attributes['user_id'],
        //             'payment_id' => Payment::where('code', $this->order->payment_method)->first()->id,
        //             'payment_method' => $this->order->payment_method,
        //             'refund_value' => $this->attributes['price'],
        //             'refunded' => 0,
        //             'image' => '',
        //             'comment' => 'By Backend',
        //         ]);
        //         break;
        //     case 'paid':

        //         break;
        // }

        // if ($value == 'paid') {
        //     $menu = Menu::find($this->remark);
        //     // $menu = $model->remark; //remark == menu_id
        //     // dd($menu);
        //     if ($menu) {
        //         $menuProduct = MenuLocationStock::where([
        //             'menu_id' => $menu,
        //             'store_id' => $this->store_id,
        //             'product_id' => $this->product_id,
        //         ])->first();

        //         $total = OrderItem::where([
        //             'product_id' => $this->product_id,
        //             'menu_date' => $this->menu_date,
        //             'store_id' => $this->store_id,
        //             'period' => $this->period,
        //             'status' => 'paid'
        //         ])->sum('quantity');

           
        //         if($menuProduct){
        //             $menuProduct->update([
        //                 'sold' => $total,
        //             ]);  
        //         }

        //     }
        // }

        $this->attributes['status'] = $value;
    }
}
