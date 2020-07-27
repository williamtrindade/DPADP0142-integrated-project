<?php

namespace App\Http\Controllers\Base;

/**
 * Interface CrudInterface
 * @package App\Http\Controllers\Base
 */
interface CrudInterface
{
    /**
     * @return string
     */
    public function getTransformer(): string;
}
