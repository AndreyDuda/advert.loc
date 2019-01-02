<?php
/**
 * Created by PhpStorm.
 * User: duda
 * Date: 02.01.19
 * Time: 15:14
 */

namespace Tests\Unit\Entity\User;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Entity\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    public function testNew()
    {
        $user = User::new(
            $name  = 'name',
            $email = 'email'
        );

        self::assertNotEmpty($user);

        self::assertEquals($name, $user->name);
        self::assertEquals($email, $user->email);
        self::assertNotEmpty($user->password);

        self::assertTrue($user->isActive());
    }
}
