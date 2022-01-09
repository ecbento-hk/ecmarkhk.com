<?php

namespace App\Http\Livewire;

use App\Http\Resources\ProductResource;
use App\Models\Period;
use App\Models\Product\Menu;
use App\Models\Product\Product;
use App\Models\Store;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class DinnerList extends Component
{
    use WithPagination;

    public $products = [];
    public $brand = 'ecbento';
    public $menu_date;
    public $period = [];
    public $periodId;
    public $menuId = 0;
    public $search = '';
    public $type;
    public $location = 31;
    public $locationName;
    public $filter = null;
    public $tags = null;
    public $user_store, $storeid;

    protected $listeners = [
        'changeMenuDate' => 'changeMenuDate',
        'startDate' => 'setStartDate',
        'updateLocation' => 'locationUpdate'
    ];

    public function setStartDate($date)
    {   
        $this->menu_date = $date;
    }

    public function locationUpdate($locationId){
        $this->locationName = Store::find($locationId)->name;
        $this->location = $locationId;
        $this->loadProduct($this->brand);
        // dd($this->products);
        $this->emit('$refresh');
    }

    public function changeMenuDate(string $date)
    {
        // dd($date);
        $this->loadProduct($date);
        // dd($this->products);
        $this->emitSelf('$refresh');
    }

    public function loadProduct($date = null)
    {
        // $this->reset(['products']);
        // $this->brand = $brand;

        
   

        if($date == null){
            $date = $this->menu_date;
        }


        $store = $this->location;
        $period_id = $this->periodId->id;
        // $menu = Menu::where([
        //     'menu_date' => $date,
        // ])->where('period_id',$period_id)
        // ->whereHas('locations', function($query) use($store){
        //     $query->where('store_id', $store)->whereNotNull('stock');
        // })->active()->first();

        $menu = Menu::where('menu_date','<=',$date)
        ->where('end_date','>=',$date)
        ->whereNotNull('end_date')
        ->where('period_id',$period_id)
        ->whereHas('locations', function($query) use($store){
            $query->where('store_id', $store)->whereNotNull('stock');
        })->active()->first();

       try {
           
            if ($menu) {
                $this->menuId = $menu->id;
                // foreach ($menu as $key => $submenu) {
                $this->products = $menu->products()->get();
                // dd($this->products);
                // }
            } else {
                $this->products = [];
                $this->filter = [];
            }

       } catch (\Throwable $th) {
            $this->products = [];
            $this->filter = [];
       }
       
        // dd($this->products);
        // $this->emit('$refresh');
    }

    public function mount($type = 'normal', $filter = null)
    {
        $period_id = 20;
        $this->periodId = Period::find( $period_id );

        $this->period = config('menu.date');
        try {
            $this->menu_date = current($this->period);
        } catch (\Throwable $th) {
            $this->menu_date = date('Y-m-d');
        }

        if($filter!==null){
            $filter = base64_decode($filter);
            $menuFilter = unserialize($filter);
            // if(isset($menuFilter['tag'])){
            //     $filter = $menuFilter['tag'];
            // }
            if(isset($menuFilter['menu_date'])){
                $filter = $menuFilter['menu_date'];
                $this->menu_date = $filter;
            }
            if(isset($menuFilter['location'])){
                $filter = $menuFilter['location'];
                $this->location = $filter;
                // if(Auth::check()){
                //     $locationId = $filter;
                //     $location = Store::find($locationId);
                //     $user = User::find(Auth::user()->id);
                //     $user->addresses()->delete();
                //     $user->addresses()->create([
                //         'city'=>'HK',
                //         'location_id' => $locationId,
                //         'province'=>'HK',
                //         'city'=>'HK',
                //         'district'=>ucwords(str_replace('-',' ',$location->area->code)),
                //         'zip'=>'00000',
                //         'address'=>$location->full_address,
                //         'contact_name'=>$user->name,
                //         'contact_phone'=>$user->phone_no,
                //         'last_used_at'=>date('Y-m-d H:i:s'),
                //     ]); 
                // } 
            }
        }

        if(Auth::check()){
            $this->storeid = $this->location;
            // $this->user_store = UserAddress::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->first();
            // $this->storeid = $this->user_store->location_id;
        } else {
            $this->storeid = $this->location;
        }

        $this->locationName = Store::find($this->storeid)->name;

        $this->filter = $filter;
        $this->type = $type;
        $this->tags = [];
        $this->loadProduct();
    }

    public function addToCart($productId,$storeId,$periodId,$menuDate)
    {
        $this->loadProduct();
        $this->emitTo('add-cart', 'addToCart', $productId, $storeId, $periodId, $menuDate, $this->menuId);
    }

    public function render()
    {
        // dd($this->products);
        return view('livewire.dinner-list');
    }
}
