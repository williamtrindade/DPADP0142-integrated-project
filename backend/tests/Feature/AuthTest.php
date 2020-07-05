<?php

namespace Tests\Feature;
use Tests\TestCase;

/**
 * Class AuthTest
 * @package Tests\Feature
 */
class AuthTest extends TestCase
{
    public function testUnauthorized()
    {
        $response = $this->get($this->getAIUrl());
        $response->assertStatus(401);
    }
}
