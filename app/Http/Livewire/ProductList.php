<?php

namespace App\Http\Livewire;

use App\Http\Resources\ProductResource;
use App\Models\Period;
use App\Models\Product\Menu;
use App\Models\Product\Product;
use App\Models\Store;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    public $products = [];
    public $brand = 'ecbento';
    public $menu_date;
    public $period = [];
    public $periodId;
    public $search = '';
    public $type;
    public $location = 54;
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
        dd($date);
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

        $menu = Menu::where([
            'menu_date' => $date,
        ])->where('period_id',$this->periodId->id)
        ->whereHas('locations', function($query) use($store){
            $query->where('store_id', $store)->whereNotNull('stock');
        })->active()->first();

        // $menu = Menu::where('menu_date','<=',$date)
        // ->where('end_date','>=',$date)
        // ->whereNotNull('end_date')
        // ->where('period_id',$period_id)
        // ->whereHas('locations', function($query) use($store){
        //     $query->where('store_id', $store)->whereNotNull('stock');
        // })->active()->first();
        if ($menu) {
            $this->products = $menu->products()->get();
        } else {
            $this->products = [];
            $this->filter = [];
        }
       
        // dd($this->products);
        // $this->emit('$refresh');
    }

    public function mount($type = 'normal', $filter = null)
    {
        $period_id = 17;
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
            }
        }

        if(Auth::check()){
            $this->user_store = UserAddress::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->first();
            $this->storeid = $this->user_store->location_id;
        } else {
            $this->storeid = $this->location;
        }

        $this->locationName = Store::find($this->storeid)->name;

        $this->filter = $filter;
        $this->type = $type;
        $this->tags = [];
        $this->loadProduct();
    }

    public function addToCart($productId,$menuDate)
    {
        $this->emitTo('add-cart', 'addToCart', $productId, $menuDate);
    }

    public function render()
    {
        // dd($this->products);
        return view('livewire.product-list');
    }
}
