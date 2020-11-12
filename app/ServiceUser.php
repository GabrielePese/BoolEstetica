<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceUser extends Model
{
    protected $fillable = [
        'service_ID',
'user_ID',
'date_end',
'riview_vote',
'riview_text',
'deleted'
    ];
}
