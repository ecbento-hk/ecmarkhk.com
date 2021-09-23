<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
       
    protected $fillable = [
        'location_id','province', 'city', 'district', 'address', 'zip','contact_name','contact_phone'
    ];
    
    protected $casts = [
        'last_used_at' => 'datetime',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function store(){
        return $this->belongsTo(Store::class);
    }

}
