<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoginDetail extends Model
{
    const UPDATED_AT = null;
    protected $fillable = [ 'user_id', 'device_ip','details' ];
}
