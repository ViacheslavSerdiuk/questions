<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function testExample()
    {
        $this->assertDatabaseHas('users', [
            'email' => 'pouros.marjolaine@example.org'
        ]);
    }
}
