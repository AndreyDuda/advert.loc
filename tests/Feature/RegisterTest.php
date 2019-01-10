<?php

namespace Tests\Feature;

use App\Entity\User;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function testForm(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200)->assertSee('Register');
    }

    public function testErrors(): void
    {
        $response = $this->post('/register', [
            'name'                  => '',
            'email'                 => '',
            'password'              => '',
            'password_confirmation' => ''
        ]);

        $response->assertStatus(302)->assertSessionHasErrors(['name', 'email', 'password']);
    }

    public function testSuccess(): void
    {
        $user = factory(User::class)->create();

        $response = $this->post('/register', [
            'name'                  => $user->name,
            'email'                 => $user->email,
            'password'              => 'secret',
            'password_confirmation' => 'secret'
        ]);

        $response
            ->assertStatus(302)
            ->assertRedirect('/');
    }

    public function testVerifyIncorrect(): void
    {
        $response = $this->get('/verify/' . Str::uuid());

        $response
            ->assertStatus(302)
            ->assertRedirect('/login')
            ->assertSessionHas('error', 'Sorry you link cannot be identified');
    }

    public function testVerify(): void
    {
        $user = factory(User::class)->create([
            'status' => User::STATUS_WAIT,
            'verify_token' => Str::uuid()
            ]);

        $response = $this->get('/verify/' . $user->verify_token);

        $response
            ->assertStatus(302)
            ->assertRedirect('/login')
            ->assertSessionHas('success', 'Your E-mail is verified. You can now login');
    }

}
