<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product\Menu;
use App\Models\Product\Product;
use DateTime;

class SubMenu extends Component
{
    public $menu_quantity = 0;
    public $menu_date = 0;
    public $location = 60;
    public $period = [2];
    
    protected $listeners = [
        'updateLocation' => 'locationUpdate'
    ];

    public function mount($type='normal',$filter = null)
    {
        $this->menu_date = date('Y-m-d');
        if($filter!==null){
            $filter = base64_decode($filter);
            $menuFilter = unserialize($filter);
            if(isset($menuFilter['tag'])){
                $filter = $menuFilter['tag'];
            }
            if(isset($menuFilter['menu_date'])){
                $filter = $menuFilter['menu_date'];
                $this->menu_date = $filter;
            }
            if(isset($menuFilter['location'])){
                // dd($filter);
                $filter = $menuFilter['location'];
                $this->location = $filter;
            }
        }
       
        $this->period = config('menu.date');
        // dd(config('menu.ordered'));
       
    }

    public function locationUpdate($locationId){
        $this->location = $locationId;
        $this->emit('$refresh');
    }

    public function menuDateUpdate($date){
        // dd($date);
        $this->menu_date = $date;
        $this->emitTo('product-list','changeMenuDate', $date);
        $this->emit('$refresh');
    }

    public function render()
    {
        $period = $this->period;
        // dd($this->period);
        $this->emitTo('product-list','startDate',$period[0]);
        // $startDate = new \DateTime('NOW');
        // $endDate = (new \DateTime('NOW'))->modify('+7 day');
        // $interval = \DateInterval::createFromDateString('1 day');
        // $period = new \DatePeriod($startDate, $interval, $endDate);
        // dd($this->location);
        dd($period);

        return view('livewire.sub-menu',['items'=>$period]);
    }
}
