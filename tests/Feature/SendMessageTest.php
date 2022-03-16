<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class SendMessageTest extends TestCase
{
    public function test_send_message_from_support_with_sending_email_notification()
    {
        $user = User::factory()->create([
            'role_id' => 1
        ]);
        $user->createToken('dev-access', ['ticket-view']);

        Sanctum::actingAs(
            $user,
            ['ticket-view']
        );

        $response = $this->post('/api/support/ticket/1/response', [
            'message' => 'qwertyqwerty',
        ]);

//        Mail::raw('Hello World!', function ($msg) {
//            $msg->to('myemail@gmail.com')->subject('Test Email');
//        });

        $response->assertCreated();
    }
    public function test_send_message_from_user()
    {
        $user = User::factory()->create([
            'role_id' => 1
        ]);
        $user->createToken('dev-access', ['ticket-view']);

        Sanctum::actingAs(
            $user,
            ['ticket-view']
        );

        $response = $this->post('/api/ticket/1/request', [
            'message' => 'qwertyqwerty',
        ]);

        $response->assertCreated();
    }
}
