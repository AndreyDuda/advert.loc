<?php

namespace App\Entity;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property bool $phone_verified
 * @property string $password
 * @property string $verify_token
 * @property string $phone_verify_token
 * @property Carbon $phone_verify_token_expire
 * @property boolean $phone_auth
 * @property string $role
 * @property string $status
 *
 * @property Network[] networks
 *
 * @method Builder byNetwork(string $network, string $identity)
 */

class User extends Authenticatable
{
    use Notifiable;

    public const STATUS_WAIT   = 'wait';
    public const STATUS_ACTIVE = 'active';

    protected $fillable = [
        'name', 'email', 'password', 'verify_token', 'status',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function register(string $name, string $email, string $password): self
    {
        return static::create([
            'name'         => $name,
            'email'        => $email,
            'password'     => bcrypt($password),
            'verify_token' => Str::uuid(),
            'status'       => self::STATUS_WAIT
        ]);
    }

    public static function new($name, $email): self
    {
        return static::create([
            'name'         => $name,
            'email'        => $email,
            'password'     => bcrypt(Str::random()),
            'verify_token' => Str::uuid(),
            'status'       => self::STATUS_ACTIVE
        ]);
    }

    public function isWait(): bool
    {
        return $this->status === self::STATUS_WAIT;
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function verify(): void
    {
        if (!$this->isWait()) {
            throw new \DomainException('User is already verified.');
        }

        $this->update([
            'status'       => self::STATUS_ACTIVE,
            'verify_token' => null,
        ]);
    }


}
