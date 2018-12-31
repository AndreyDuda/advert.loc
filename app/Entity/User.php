<?php

namespace App\Entity;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App\Entity
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $status
 * @property string $verify_code
 */
class User extends Authenticatable
{
    use Notifiable;

    public const STATUS_WAIT   = 'wait';
    public const STATUS_ACTIVE = 'active';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
