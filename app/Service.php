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
        'photo',
        'video',
        'promotion',
        'disable',
        'delete'
    ];
    public function users(){
        return $this ->belongsToMany(User::class); //->withPivot('id', 'service_ID','user_ID', 'date_end' , 'riview_vote', 'riview_text', 'deleted')
    }
    public function promotion(){
        return $this ->belongsTo(Promotion::class);
    }


}
