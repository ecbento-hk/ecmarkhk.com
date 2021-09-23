<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use App\Models\Order\Order;
use App\Models\Order\OrderItem;
use App\Models\Product\MenuLocationStock;
use App\Models\Product\Product;
use App\Models\Store;
use App\Models\VM\MachineProduct;
use Illuminate\Http\Request;
use Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

use App\OrderLog;

class LogisticsController extends Controller
{

 
    // public function index()
    // {
    //     $lists = Area::where(['type' => 'sub-district', 'active' => 1])->orderBy('priority')->get();
    //     return view('logistics.index', ['lists' => $lists]);
    // }

    // public function store(Aree $location)
    // {
    //     $lists = $location->store;
    //     // dd($lists);
    //     return view('logistics.store', ['lists' => $lists]);
    // }

    public function machine(Request $request, Store $store)
    {
        $lists = $store->machines;
        // dd($store);
        return view('logistics.machines', ['lists' => $lists, 'store' => $store]);
    }

    public function machineStatus(Store $store, Machine $machine)
    {

        $encodedVerison = explode(':', $machine->version);
        $version = $encodedVerison[0];
        $secret = $encodedVerison[1];



        // $arr2 = [
        //     'appId' => $version,
        //     'bizData' => '{"deviceId":"'.$machine->imei.'"}',
        //     'method' => 'device.status.query',
        //     'timestamp' => date('Y-m-d H:i:s'),
        //     'version' => '1.0',
        // ];
        // $md52 = "";
        // $i = 1;
        // foreach ($arr2 as $key => $value) {
        //     $md52 = $md52.$key.'='.$value;
        //     if( $i < count($arr2) ){
        //         $md52 = $md52.'&';
        //     }
        //     $i++;
        // }
        // // dd($md52);
        // $encoded2 = hash_hmac('md5', $md52, $secret);
        // $arr2['digest'] = $encoded2;
        // $response2 = Http::get('https://openapi.58auv.com/gateway.do', $arr2);
        // $result2 = $response2->json();
        // $status = $result2;
        // if(!$status){
        //     $status['resultObject'] = [
        //         'deviceStatus' => 'API ERROR',
        //     ];
        // }
        // dd($status);

        // dd($secret);
        // $arr = [
        //     'appId' =>  $version,
        //     'bizData' => '{"status":1,"page":10,"deviceId":"'.$machine->imei.'","timeStart":"2021-03-02 00:00:00","timeEnd":"'.date('Y-m-d').' 23:59:59"}',
        //     'method' => 'getOrderList',
        //     'timestamp' => date('Y-m-d H:i:s'),
        //     'version' => '1.0',
        // ];
        // $md5 = "";
        // $i = 1;
        // foreach ($arr as $key => $value) {
        //     $md5 = $md5.$key.'='.$value;
        //     if( $i < count($arr) ){
        //         $md5 = $md5.'&';
        //     }
        //     $i++;
        // }

        // $encoded = hash_hmac('md5', $md5, $secret);
        // $arr['digest'] = $encoded;

        // $response = Http::get('https://plat.58auv.com/OpenApi', $arr);
        // $lists =  $response->json();
        // // $curl = curl_init($url);
        // // curl_setopt($curl, CURLOPT_POST, true);
        // // curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($arr));
        // // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // // $response = curl_exec($curl);
        // // $lists = json_decode((string) $response,true);
        // // curl_close($curl);
        // // dd($lists);
        // if(!isset($lists['resultObject'])){
        //     // echo json_encode($arr);
        //     // echo json_encode($machine);
        //     $lists['resultObject']['data'] = [];
        //     $lists['resultObject']['machine'] = $machine;
        //     $lists['resultObject']['arr'] = $arr;
        // }
        // dd($lists);

        $url = 'https://api2.ecbento.com/v1/calling/58auv/' . $secret . '/' . $version . '/' . $machine->imei . '/orders';
        // $response = Http::get($url, []);
        $response = file_get_contents($url);
        $cells = json_decode((string) $response, true);
        // dd($cells);
        return view('logistics.status', ['machine' => $machine, 'store' => $store, 'lists' => [], 'cells' => $cells['resultObject'], 'status' => []]);
    }

    public function supplier(Request $request)
    {
        $machine = 'foodlocker';
        $lists = OrderItem::where('menu_date', '>=', date('Y-m-01') . '%')->groupBy('product_id')->select('product_id')->get()->pluck('product_id');
        $products = Product::whereIn('id', $lists)->select('brand_id')->groupBy('brand_id')->get();
        return view('logistics.supplier', ['lists' => $products, 'machine' => $machine]);
    }

    //上貨表
    public function shelf(Request $request, Store $store)
    {
        // $machine = 'foodlocker';
        if ($request->machine) {
            $machine = Machine::find($request->machine);
        } else {
            $machine = $store->machines->first();
        }
        if ($machine) {
            $menuDate = date('Y-m-d');
            // if (date('w') == 6) {
            //     $menuDate = date("Y-m-d", strtotime("$menuDate +2 day"));
            // }
            if (date('w') == 7) {
                $menuDate = date("Y-m-d", strtotime("$menuDate +1 day"));
            }
            if (date('H') >= 21) {
                $menuDate = date("Y-m-d", strtotime("$menuDate +1 day"));
            }
            // $menuDate = date( "Y-m-d", strtotime( "$menuDate +2 day" ) );


            switch ($machine->type) {
                case 'pickup_machine':
                    if ($store->id == 39) {
                        $lists = Menu::where([
                            'menu_date' => $menuDate,
                            'active' => 1,
                            'period_id' => 2
                        ])->orWhere('menu_date', '8888-12-31')->get()->pluck('id');
                    } else if ($store->id == 37) {
                        $lists = Menu::where([
                            'menu_date' => $menuDate,
                            'active' => 1,
                        ])->whereIn('period_id', [2, 3, 5])->get()->pluck('id');
                    } else if ($store->id == 38) {
                        $lists = Menu::where([
                            'menu_date' => $menuDate,
                            'active' => 1,
                        ])->whereIn('period_id', [2, 3, 5])->get()->pluck('id');
                    } else if ($store->id == 54) {
                        $lists = Menu::where([
                            'menu_date' => $menuDate,
                            'active' => 1,
                        ])->whereIn('period_id', [2, 3, 15])->get()->pluck('id');
                    } else {
                        $lists = Menu::where([
                            'menu_date' => $menuDate,
                            'active' => 1,
                            'period_id' => 2
                        ])->get()->pluck('id');
                    }

                    if ($lists) {
                        $lists = MenuLocationStock::where([
                            'store_id' => $store->id
                        ])->whereIn('menu_id', $lists)->get();
                        // $lists = $lists->products;
                        // dd($lists);
                    }
                    break;
                case 'foodlocker':
                    $lists = OrderItem::where('menu_date', $menuDate)->where([
                        'store_id' => $store->id,
                    ])->whereNotIn('user_id', ['26026', '18263'])->whereNotIn('ship_status', [ 'cancelled'])->get();
                    break;

                    // default:
                    //     dd($storeMachine);
                    // break;
            }
        }
        // dd($storeMachine);
        return view('logistics.loading', ['lists' => $lists, 'machine' => $machine, 'store' => $store]);
    }

    //上貨
    public function create(Request $request, $machine, $orderClass, $orderId, $boxSize, $warm = 1)
    {
        $machine = Machine::find($machine);
        // dd($machine->type);

        switch ($machine->type) {
            case 'foodlocker':
                if ($orderClass == 'order') {
                    $order = Order::find($orderId);
                    $order->items()->where([
                        'menu_date' => date('Y-m-d')
                    ])->update([
                        'machine_id' => $machine->id
                    ]);
                    // dd($machine);
                    $exists = MachineProduct::where([
                        'product_type' => 'App\Order',
                        'product_id' => $orderId,
                    ])->whereDate('created_at', date('Y-m-d'))->first();
                    if ($exists) {
                        return [
                            'message' => 'Already Exists'
                        ];
                    }
                    $orderItem = $order->items()->where([
                        'menu_date' => date('Y-m-d')
                    ])->first();
                    // \Log::debug('$orderItem->status:'.$orderItem->ship_status);
                    //try{
                    //fcm_remind('ready', $orderId, $orderItem);
                    //} catch($th) {
                    //}
                } else {
                    $order = MenuLocationStock::find($orderId);
                }


                $encodedVerison = explode(':', $machine->version);
                $version = $encodedVerison[0];
                $secret = $encodedVerison[1];
                $ver = '1.0';
                if ($version == '66585') {
                    $ver = '1.0.3';
                }
                $arr = [
                    'appId' => $version,
                    'bizData' => '{"deviceId":"' . $machine->imei . '","shopOrderId":"' . date('YmdHis') . $orderId . '","type":"' . $boxSize . '","isWarm":"' . $warm . '","isLight":"1","isDisinfect":"0"}',
                    'method' => 'createOrder',
                    'timestamp' => date('Y-m-d H:i:s'),
                    'version' => $ver,
                ];
                $md5 = "";
                $i = 1;
                foreach ($arr as $key => $value) {
                    $md5 = $md5 . $key . '=' . $value;
                    if ($i < count($arr)) {
                        $md5 = $md5 . '&';
                    }
                    $i++;
                }
                $encoded = hash_hmac('md5', $md5, $secret);
                $arr['digest'] = $encoded;
                // dd($arr);
                $response = Http::get('https://plat.58auv.com/OpenApi', $arr);
                $result = $response->json();
                // $result = json_decode($result, TRUE);
                if ($result['code'] == "10000") {
                    $newCode = $result['resultObject']['orderId'];

                    if ($orderClass == 'order') {
                        $order = Order::find($orderId);
                        OrderItem::where([
                            'menu_date' => date('Y-m-d'),
                            'order_id' => $order->id
                        ])->update([
                            'ship_status' => 'processing',
                        ]);
                        MachineProduct::create([
                            'product_type' => 'App\Order',
                            'product_id' => $orderId,
                            'track_y' => $result['resultObject']['orderId'],
                            'track_x' => $result['resultObject']['cellId'],
                            'track_type' => 1,
                            'machine_id' => $machine->id,
                            'stock' => $order->items()->where([
                                'menu_date' => date('Y-m-d')
                            ])->count(),
                            'stock_count' => $order->items()->where([
                                'menu_date' => date('Y-m-d')
                            ])->count(),
                            'sold_count' => 0,
                            'publish_at' => date('Y-m-d H:i:s'),
                        ]);
                        OrderItem::where([
                            'menu_date' => date('Y-m-d'),
                            'order_id' => $order->id
                        ])->update([
                            'ship_data' => $result,
                            'ship_status' => 'ready',
                        ]);
                    } else {
                        MachineProduct::create([
                            'product_type' => MenuLocationStock::class,
                            'product_id' => $orderId,
                            'track_y' => $result['resultObject']['orderId'],
                            'track_x' => $result['resultObject']['cellId'],
                            'track_type' => 1,
                            'machine_id' => $machine->id,
                            'stock' => 1,
                            'stock_count' => 1,
                            'sold_count' => 0,
                            'publish_at' => date('Y-m-d H:i:s'),
                        ]);
                    }


                    return redirect()->back();
                } else if ($result['code'] == '10014') {
                    dd($result);
                } else {
                    print_r($arr);
                    dd($result);
                    return redirect()->back()->withError(['message' => 'Cannot Create Order']);
                }
                break;
    
        }
    }

    //Only for foodlocker: 加櫃
    public function add($machine, $orderId, $boxSize)
    {
        $order = Order::find($orderId);
        $machine = Machine::find($machine);
        // dd($machine);
        $exists = MachineProduct::where([
            'product_type' => 'App\Order',
            'product_id' => $orderId,
        ])->whereDate('created_at', '=', date('Y-m-d'))->first();
        if (!$exists) {
            return [
                'message' => 'Order Not Found'
            ];
        }
        $encodedVerison = explode(':', $machine->version);
        $version = $encodedVerison[0];
        $secret = $encodedVerison[1];

        $orderId = $exists->track_y;
        $arr = [
            'appId' => $version,
            'bizData' => '{"deviceId":"' . $machine->imei . '","orderId":"' . $orderId . '","type":"' . $boxSize . '","isWarm":"1"}',
            'method' => 'addCell',
            'timestamp' => date('Y-m-d H:i:s'),
            'version' => '1.0',
        ];
        $md5 = "";
        $i = 1;
        foreach ($arr as $key => $value) {
            $md5 = $md5 . $key . '=' . $value;
            if ($i < count($arr)) {
                $md5 = $md5 . '&';
            }
            $i++;
        }
        $encoded = hash_hmac('md5', $md5, $secret);
        $arr['digest'] = $encoded;
        // dd($arr);
        $response = Http::get('https://plat.58auv.com/OpenApi', $arr);
        $result = $response->json();
        // $result = json_decode($result, TRUE);
        if ($result['code'] == "10000") {
            $exists->update([
                'track_x' => $result['resultObject']['cellId'],
            ]);
            OrderItem::where([
                'menu_date' => date('Y-m-d'),
                'order_id' => $orderId
            ])->update([
                'ship_data' => $result,
            ]);
            return redirect()->back();
        } else if ($result['code'] == '10014') {
            // dd($result);
            $arr = [
                'appId' => $version,
                'bizData' => '{"deviceId":"' . $machine->imei . '","orderId":"' . $orderId . '","type":"' . $boxSize . '","isWarm":"2"}',
                'method' => 'addCell',
                'timestamp' => date('Y-m-d H:i:s'),
                'version' => '1.0',
            ];
            $md5 = "";
            $i = 1;
            foreach ($arr as $key => $value) {
                $md5 = $md5 . $key . '=' . $value;
                if ($i < count($arr)) {
                    $md5 = $md5 . '&';
                }
                $i++;
            }
            $encoded = hash_hmac('md5', $md5, $secret);
            $arr['digest'] = $encoded;
            // dd($arr);
            $response = Http::get('https://plat.58auv.com/OpenApi', $arr);
            $result = $response->json();

            if ($result['code'] == "10000") {
                $exists->update([
                    'track_x' => $result['resultObject']['cellId'],
                ]);
                OrderItem::where([
                    'menu_date' => date('Y-m-d'),
                    'order_id' => $orderId
                ])->update([
                    'ship_data' => $result,
                ]);
                return redirect()->back();
            } else {
                dd($result);
            }
        } else {
            dd($result);
            return redirect()->back()->withError(['message' => 'Cannot Create Order']);
        }
    }


    public function action(Machine $machine, $no, $action)
    {

        $encodedVerison = explode(':', $machine->version);
        $version = $encodedVerison[0];
        $secret = $encodedVerison[1];

        // event(new FoodlockerProcessed($machine,$action,$no));

        // dd($machine);

        if ($action == 'CANCEL_ALL_ORDER') {
            $action == 'CANCEL_ORDER';

            $url = 'https://api2.ecbento.com/v1/calling/58auv/' . $secret . '/' . $version . '/' . $machine->imei . '/orders';
            $response = file_get_contents($url);
            $cells = json_decode((string) $response, true);
            if($cells['resultObject']){
                foreach ($cells['resultObject'] as $key => $value) {
                    if(in_array($value['cellId'],[13,14,15,16,29,30,31,32,45,46,47,48])){
                        continue;
                    } else {
                        $no = $value['orderId'];
                        $exists = MachineProduct::where([
                            'track_y' => $no,
                        ])->first();
                        if ($exists) {
                            MachineProduct::where([
                                'track_y' => $no,
                            ])->delete();
                        }
            
                        $url = 'https://api2.ecbento.com/v1/calling/58auv/' . $secret . '/' . $version . '/' . $machine->imei . '/' . 'CANCEL_ORDER' . '/' . $no;
                        $response = Http::get($url, []);
                        $result = $response->json();
                        \Log::debug('cancel all order');
                        \Log::debug($result);
                    }
                    
                    // return $result;
                }
            }
        }

        if ($action == 'CANCEL_ORDER') {
            //delete DB record
            $exists = MachineProduct::where([
                'track_y' => $no,
            ])->first();
            if ($exists) {
                MachineProduct::where([
                    'track_y' => $no,
                ])->delete();
            } else {
                // return [
                //     'message' => 'Order Not Found'
                // ];
            }



            $url = 'https://api2.ecbento.com/v1/calling/58auv/' . $secret . '/' . $version . '/' . $machine->imei . '/' . $action . '/' . $no;
            $response = Http::get($url, []);
            $result = $response->json();
            // dd($url);
            \Log::debug($result);
            return $result;
            // return redirect()->back()->withError(['message'=>'Cancel Order']);

            // $arr = [
            //     'appId' => $version,
            //     'bizData' => '{"deviceId":"'.$machine->imei.'","orderId":"'.$no.'"}',
            //     'method' => 'cancelOrder',
            //     'timestamp' => date('Y-m-d H:i:s'),
            //     'version' => '1.0',
            // ];
            // $md5 = "";
            // $i = 1;
            // foreach ($arr as $key => $value) {
            //     $md5 = $md5.$key.'='.$value;
            //     if( $i < count($arr) ){
            //         $md5 = $md5.'&';
            //     }
            //     $i++;
            // }
            // $encoded = hash_hmac('md5', $md5, $secret);
            // $arr['digest'] = $encoded;

            // $response = Http::get('https://plat.58auv.com/OpenApi', $arr);
            // $lists =  $response->json();
            // return redirect()->back()->withError(['message'=>'Cancel Order']);
        }


        $url = 'https://api2.ecbento.com/v1/calling/58auv/' . $secret . '/' . $version . '/' . $machine->imei . '/' . $action . '/' . $no;
        $response = Http::get($url, []);
        $result = $response->json();

        return $url;

        if ($no == 'all') {
            $result['code'] = 0;

            for ($cell = 0; $cell <= 48; ++$cell) {

                $arr = [
                    'appId' => $version,
                    'bizData' => '{"deviceId":"' . $machine->imei . '","cellNo":"' . $cell . '","op":"' . $action . '"}',
                    'method' => 'device.cell.op',
                    'timestamp' => date('Y-m-d H:i:s'),
                    'version' => '1.0',
                ];
                $md5 = "";
                $i = 1;
                foreach ($arr as $key => $value) {
                    $md5 = $md5 . $key . '=' . $value;
                    if ($i < count($arr)) {
                        $md5 = $md5 . '&';
                    }
                    $i++;
                }
                $encoded = hash_hmac('md5', $md5, $secret);
                $arr['digest'] = $encoded;
                $response = Http::get('https://openapi.58auv.com/gateway.do', $arr);
                $result = $response->json();


                // return $response->json();
            }
            if ($result['code'] == 1) {
                // return back();
                return $result;
            } else {
                return $result;
            }
        } else {

            $arr = [
                'appId' => $version,
                'bizData' => '{"deviceId":"' . $machine->imei . '","cellNo":"' . $no . '","op":"' . $action . '"}',
                'method' => 'device.cell.op',
                'timestamp' => date('Y-m-d H:i:s'),
                'version' => '1.0',
            ];
            // dd($arr);

            $md5 = "";
            $i = 1;
            foreach ($arr as $key => $value) {
                $md5 = $md5 . $key . '=' . $value;
                if ($i < count($arr)) {
                    $md5 = $md5 . '&';
                }
                $i++;
            }
            $encoded = hash_hmac('md5', $md5, $secret);
            $arr['digest'] = $encoded;
            $response = Http::get('https://openapi.58auv.com/gateway.do', $arr);
            $result = $response->json();
            // return $response->json();
            if ($result['code'] == 1) {
                return $result;
            } else {
                return $result;
            }
        }
    }
}
