<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * @return mixed
     */
    public function getAIUrl(): string
    {
        return env('APP_URL');
    }
}
