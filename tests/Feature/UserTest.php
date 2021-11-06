<?php

namespace Tests\Feature;

use App\Http\Resources\UserRecourse;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use WithFaker, DatabaseTransactions;

    const DEFAULT_PASSWORD = '12345678';

    private $user;

    public function setUp(): void
    {
        parent::setup();

        $this->user = User::factory()->create([
            'password'  =>  bcrypt(self::DEFAULT_PASSWORD)
        ]);
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_user()
    {
        $name     = $this->faker->name;
        $email    = $this->faker->email;
        $password = $this->faker->password;
        $response = $this->post('/users/create', [
            'name'                   =>  $name,
            'email'                  =>  $email,
            'password'               =>  $password,
            'password_confirmation'  =>  $password
        ]);

        $this->assertDatabaseHas('users', [
            'name'   =>  $name,
            'email'  =>  $email
        ]);

        $response->assertStatus(201);
    }

    public function test_create_user_has_error()
    {
        $password = $this->faker->password(6, 6);

        $response = $this->post('/users/create', [
            'name'                   =>  null,
            'email'                  =>  null,
            'password'               =>  $password,
            'password_confirmation'  =>  $password
        ]);

        $response->assertSessionHasErrors(['name', 'email']);


    }

    public function test_user_login()
    {
        $response = $this->post('/login', [
            'username' => $this->user->email,
            'password' => self::DEFAULT_PASSWORD
        ]);

        $response->assertRedirect(route('welcome'));
    }

    public function test_user_login_has_errors()
    {
        $response = $this->post('/login', [
            'username' => $this->user->email,
            'password' => $this->faker->password
        ]);

        $response->assertRedirect(route('login'));
    }

    public function test_logged_in_user_can_logout()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('welcome'));

        $response->assertViewIs('welcome');

        $this->get(route('logout'));

        $response = $this->get(route('welcome'));

        $response->assertRedirect(route('login'));
    }

    public function test_all_users_resource()
    {
        $users = UserRecourse::collection(User::all());

        $this->json('get', '/api/users')
            ->assertOk()
            ->assertJsonStructure([
                'data'  =>  [
                    '*' => [
                        'id',
                        'name',
                        'email',
                        'email_verified_at',
                        'created_at',
                        'updated_at'
                    ]
                ]
            ]);
    }
}
