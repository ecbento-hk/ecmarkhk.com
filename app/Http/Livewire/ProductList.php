<?php

namespace App\Http\Livewire;

use App\Http\Resources\ProductResource;
use App\Models\Product\Menu;
use App\Models\Product\Product;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    protected $products = [];
    public $brand = 'ecbento';
    public $menu_date;
    public $period = [];
    public $search = '';
    public $type;
    public $location = 54;
    public $filter = null;
    public $tags = null;
    public $user_store, $storeid;

    protected $listeners = [
        'brandUpdate' => 'changeBrand',
        'startDate' => 'setStartDate',
        'updateLocation' => 'locationUpdate'
    ];

    public function setStartDate($date)
    {   
        $this->menu_date = $date;
    }

    public function locationUpdate($locationId){
        $this->location = $locationId;
        $this->loadProduct($this->brand);
        // dd($this->products);
        $this->emit('$refresh');
    }

    public function changeBrand(string $brand)
    {
        $this->brand = $brand;
        $this->loadProduct($brand);
        $this->emitSelf('$refresh');
    }

    public function loadProduct($brand)
    {
        // $this->reset(['products']);
        $this->brand = $brand;

        $period_id = [2];
        $store = $this->location;
        $menu = Menu::where([
            'menu_date' => $this->menu_date,
        ])->whereIn('period_id',$period_id)
        ->whereHas('locations', function($query) use($store){
            $query->whereIn('store_id', [$store])->where('active',1)->whereNotNull('stock');
        })->active()->first();
        if ($menu) {
            $this->products = ProductResource::collection($menu->products()->get());
            // dd($this->products);
        } else {
            $this->products = [];
            $this->filter = [];
        }

        // $this->emit('$refresh');
    }

    public function mount($type = 'normal', $filter = null)
    {
        // dd($filter);

        $this->period = config('menu.date');
        
        try {
            $this->menu_date = current($this->period);
        } catch (\Throwable $th) {
            $this->menu_date = date('Y-m-d');
        }

        if($filter!==null){
            $filter = base64_decode($filter);
            $menuFilter = unserialize($filter);
            // dd($menuFilter);
            if(isset($menuFilter['tag'])){
                $filter = $menuFilter['tag'];
            }
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

        $this->filter = $filter;
        $this->type = $type;
        $this->tags = \DB::table('taggables')->get();
        $this->loadProduct($this->brand);
    }

    public function addToCart($productId,$menuDate)
    {
        // dd($menuDate);
        $this->emitTo('add-cart', 'addToCart', $productId, $menuDate);
    }

    public function render()
    {
        return view('livewire.product-list', [
            'products' => $this->products,
            'tag' => $this->filter,
            'menu_date' => $this->filter
        ]);
    }
}
