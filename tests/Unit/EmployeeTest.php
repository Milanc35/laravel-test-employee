<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Http\Response;
use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployeeTest extends TestCase
{
    use RefreshDatabase, WithFaker;

     protected function setUp(): void
     {
         parent::setUp();

         $this->user = factory(User::class)->create();
     }

     /** @test */
     public function request_should_fail_when_no_title_is_provided()
     {
         $response = $this->actingAs($this->user)
             ->postJson(route('admin.employees.store'), [
                 'price' => $this->faker->numberBetween(1, 50)
             ]);

         $response>assertStatus(
             Response::HTTP_UNPROCESSABLE_ENTITY
         );

         $response->assertJsonValidationErrors('first_name');
     }

     /** @test */
     public function request_should_fail_when_no_price_is_provided()
     {
         $response = $this->actingAs($this->user)
             ->postJson(route('admin.employees.store'), [
                 'first_name' => $this->faker->firstName
             ]);

         $response->assertStatus(
             Response::HTTP_UNPROCESSABLE_ENTITY
         );

         $response->assertJsonValidationErrors('email');
     }

     /** @test */
     public function request_should_fail_when_title_has_more_than_50_characters()
     {
         $response = $this->actingAs($this->user)
             ->postJson(route('admin.employees.store'), [
                 'first_name' => $this->faker->firstName
             ]);

         $response->assertStatus(
             Response::HTTP_UNPROCESSABLE_ENTITY
         );

         $response->assertJsonValidationErrors('email');
     }

     /** @test */
     public function request_should_pass_when_data_is_provided()
     {
         $response = $this->actingAs($this->user)
             ->postJson(route('admin.employees.store'), [
                 'first_name' => $this->faker->firstName,
                 'last_name' => $this->faker->lastName
             ]);

         $response->assertStatus(Response::HTTP_CREATED);

         $response->assertJsonMissingValidationErrors([
             'first_name',
             'last_name',
             'email',
         ]);
     }
}
