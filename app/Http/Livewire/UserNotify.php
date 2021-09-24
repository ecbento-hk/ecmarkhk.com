<?php

namespace App\Http\Livewire;

use App\Models\Store;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserNotify extends Component
{
    public $stores, $user_store, $storeid;
    
    public function mount($location = null)
    {
        $this->stores = Store::where('active',1)->whereIn('id',[58,31])->get();
        if(Auth::check()){
        $this->user_store = UserAddress::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->first();
        $this->storeid = $this->user_store->location_id;
        } else {
            $this->storeid = 54;

            if($location!==null){
                $this->storeid = $location;
            }

        }
    }
   
    // public function updateStore($storeId)
    // {
    //     if($storeId){
    //         $this->user_store = $storeId;
    //     } else {
    //         $this->user_store = 54;
    //     }
    //     config()->set('menu.store', $this->user_store);
    // }
   
    public function updatedStoreid($value)
    {
        if(Auth::check()){
            $locationId = $value;
            $location = Store::find($locationId);
            $user = User::find(Auth::user()->id);
            $user->addresses()->create([
                'city'=>'HK',
                'location_id' => $locationId,
                'province'=>'HK',
                'city'=>'HK',
                'district'=>ucwords(str_replace('-',' ',$location->area->code)),
                'zip'=>'00000',
                'address'=>$location->full_address,
                'contact_name'=>$user->name,
                'contact_phone'=>$user->phone_no,
                'last_used_at'=>date('Y-m-d H:i:s'),
            ]);
        } 
        // else {
            // $this->emitTo('sub-menu','updateLocation',$value);
            // $this->emitTo('product-list','updateLocation',$value);
        // }
        $this->storeid = $value;
        // config()->set('menu.store', $value);   
        $payload = serialize(['location'=>$value]);
        return redirect()->route('welcome',[
            'menu' => base64_encode($payload)
        ]);
        // dd(url()->current());
        // return redirect(Request::url());
    }
   
    public function render()
    {
        return view('livewire.user.user-notify');
    }
}
