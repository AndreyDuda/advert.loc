<?php
/**
 * Created by PhpStorm.
 * User: duda
 * Date: 05.01.19
 * Time: 11:59
 */

namespace Tests\Unit\Entity\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Entity\User;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    public function testChange(): void
    {
        $user = factory(User::class)->create(['role' => User::ROLE_USER]);

        self::assertFalse($user->isAdmin());

        $user->changeRole(User::ROLE_ADMIN);

        self::assertTrue($user->isAdmin());
    }

    public function testAlready()
    {
        $user = Factory(User::class)->create(['role' => User::ROLE_ADMIN]);

        $this->expectExceptionMessage('Role is already assigned.');

        /** @var User $user */
        $user->changeRole(User::ROLE_ADMIN);
    }

}
