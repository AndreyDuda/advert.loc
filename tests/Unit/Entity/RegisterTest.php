<?php
/**
 * Created by PhpStorm.
 * User: duda
 * Date: 31.12.18
 * Time: 16:03
 */

namespace Tests\Unit\Entity;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Entity\User;

class RegisterTest extends TestCase
{
    /*use RefreshDatabase;*/

    public function testRequest(): void
    {
        $user = User::register(
            $name     = 'name',
            $email    = 'email',
            $password = 'password'
        );

        self::assertNotEmpty($user);

        self::assertEquals($name, $user->name);
        self::assertEquals($email, $user->email);

        self::assertNotEmpty($user->password);
        self::assertNotEquals($password, $user->password);

        self::assertTrue($user->isWait());
        self::assertFalse($user->isActive());
    }

    public function testVerify(): void
    {
        $user = User::register('name', 'email', 'password');

        $user->verify();

        self::asserFalse($user->isWait());
        self::asserTrue($user->isActive());
    }

    public function testAlreadyVerified(): void
    {
        $user = User::register('name', 'email', 'password');

        $user->verify();

        $this->expectExceptionMessage('User is already verified.');
        $user->verify();
    }


}
