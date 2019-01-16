<?php

namespace App\Entity\Adverts\Dialog;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Entity\User;

class Dialog extends Model
{
    protected $table = 'advert_dialogs';
    protected $guarded = ['id'];
}
