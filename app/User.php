<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

    
    class User extends Authenticatable
    {
        use Notifiable;
        
        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
            'name',
            'lastname',
            'email',
            'password',
        'phone',
        'admin'
    ];
        public function services(){
            return $this ->belongsToMany(Service::class); //-> withPivot('id','service_ID','user_ID','date_end','riview_vote','riview_text','deleted')
        }
    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
