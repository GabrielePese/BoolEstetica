<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'description',
        'duration',
        'price',
        'originalprice',
        'photo',
        'video',
        'promotion',
        'disable',
        'delete'
    ];
    public function users(){
        return $this ->belongsToMany(User::class)->withPivot('id','user_ID','service_ID', 'date_end', 'review_vote', 'review_text', 'deleted');
    }
    public function promotion(){
        return $this ->hasMany(Promotion::class);
    }


}
