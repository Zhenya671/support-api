<?php

namespace Tests\Feature;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TicketTest extends TestCase
{
    public function test_show_tickets_for_user()
    {
        $user = User::first();
        $user->createToken('dev-access', ['ticket-view']);

        Sanctum::actingAs(
            $user,
            ['ticket-view']
        );

        $response = $this->get('/api/ticket');

        $response->assertOk();
    }

    public function test_create_ticket()
    {
        $user = User::factory()->create();
        $user->createToken('dev-access', ['ticket-view']);

        Sanctum::actingAs(
            $user,
            ['ticket-view']
        );

        $response = $this->post('/api/ticket', [
            'header' => 'qwertyqwerty',
            'theme' => 'qwertyqwerty',
            'email' => 'qwe@qwe.qwe',
            'description' => 'qwertyqwerty'
        ]);

        $response->assertCreated();
    }

    public function test_show_ticket_by_id()
    {
        $user = User::factory()->create();
        $user->createToken('dev-access', ['ticket-view']);

        Sanctum::actingAs(
            $user,
            ['ticket-view']
        );

        $response = $this->get('/api/ticket/1');

        $response->assertOk();
    }
}
