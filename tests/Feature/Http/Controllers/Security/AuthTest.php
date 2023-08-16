<?php

namespace Tests\Feature\Http\Controllers\Security;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\StaticData\Http\Controllers\Security\CorrectUserAuthenticateRequestData;
use Tests\StaticData\Http\Controllers\Security\CorrectUserRegisterRequestData;
use Tests\StaticData\Http\Controllers\Security\IncorrectUserAuthenticateRequestData;
use Tests\StaticData\Http\Controllers\Security\IncorrectUserRegisterRequestData;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_signup_when_user_data_is_correct_then_status_200_and_user_data(): void
    {
        $response = $this->postJson('/api/auth/sign-up', (new CorrectUserRegisterRequestData())->asArray());

        $response
            ->assertCreated()
            ->assertJson(
                fn(AssertableJson $json) => $json
                    ->hasAll(['data.name', 'data.email', 'data.auth_token'])
                    ->missingAll(['data.id', "data.created_at", "data.updated_at"])
            );
    }

    public function test_signup_when_user_data_is_correct_with_email_already_in_use_then_status_422_and_email_validation(): void
    {
        $this->postJson('/api/auth/sign-up', (new CorrectUserRegisterRequestData())->asArray());

        $response = $this->postJson('/api/auth/sign-up', (new CorrectUserRegisterRequestData())->asArray());

        $response
            ->assertUnprocessable()
            ->assertJson(
                fn(AssertableJson $json) => $json
                    ->hasAll(['message', 'errors.email'])
            );
    }

    public function test_signup_when_user_data_is_incorrect_then_status_422_and_email_name_password_validation(): void
    {
        $response = $this->postJson('/api/auth/sign-up', (new IncorrectUserRegisterRequestData())->asArray());

        $response
            ->assertUnprocessable()
            ->assertInvalid(['name', 'email', 'password'])
            ->assertJsonCount(2, "errors.password");
    }

    public function test_signin_when_user_data_is_correct_then_status_200_and_auth_token(): void
    {
        $this->postJson('/api/auth/sign-up', (new CorrectUserRegisterRequestData())->asArray());

        $response = $this->postJson('/api/auth/sign-in', (new CorrectUserAuthenticateRequestData())->asArray());

        $response
            ->assertOk()
            ->assertJson(
                fn(AssertableJson $json) => $json
                    ->hasAll(['data.auth_token'])
                    ->missingAll(['data.id', "data.created_at", "data.updated_at", 'data.name', 'data.email',])
            );
    }

    public function test_signin_when_user_data_is_correct_then_status_401_and_authentication_fail(): void
    {
        $response = $this->postJson('/api/auth/sign-in', (new CorrectUserAuthenticateRequestData())->asArray());

        $response
            ->assertUnauthorized()
            ->assertInvalid(["email"])
            ->assertJson(
                fn(AssertableJson $json) => $json
                    ->hasAll(['message', "errors"])
            );
    }

    public function test_signup_when_user_data_is_incorrect_then_status_422_and_email_password_validation(): void
    {
        $response = $this->postJson('/api/auth/sign-up', (new IncorrectUserAuthenticateRequestData())->asArray());

        $response
            ->assertUnprocessable()
            ->assertInvalid(['email', 'password']);
    }
}
