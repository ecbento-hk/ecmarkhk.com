<?php

use App\Models\Order\OrderItem;
use App\Models\Product\Menu;
use App\Models\Product\MenuLocationStock;
use Illuminate\Support\Facades\DB;

if (! function_exists('check_stock')) {
    function check_stock($menu_id, $sold) {
        // return $menu_id;
        if($menu_id == 0){
            return false;
        }
        // dd($menu_id);
        // $menu = Menu::find($menu_id);
        // $menuProduct = MenuLocationStock::where(['menu_id'=>$menu_id,'product_id'=>$product_id,'store_id'=>$store_id])->sum('quantity');
        $menuProduct = MenuLocationStock::find(213);
        dd($menuProduct);
        if($menuProduct<$sold){
            return $menuProduct;
        }

        try {
            
        } catch (\Throwable $th) {
            return false;
        }   
        return false;
    }
}