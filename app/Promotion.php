<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = [
        'service_ID',
        'name',
        'discount'
    ];

    public function services(){ 
        return $this ->belongsTo (Service::class);// ->withPivot('ID', 'service_ID','name', 'discount');
    }
}
