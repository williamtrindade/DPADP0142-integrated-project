<?php

namespace Tests\Feature;
use Tests\TestCase;

/**
 * Class AuthTest
 * @package Tests\Feature
 */
class AuthTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetAccessToken()
    {
        $response = $this->get($this->getAIUrl());

        $response->assertStatus(401);
    }
}
