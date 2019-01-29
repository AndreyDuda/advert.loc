<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Network extends Model
{
    protected $table = 'user_networks';

    protected $fillable = ['network', 'identity'];

    public $timestamps = false;
}
