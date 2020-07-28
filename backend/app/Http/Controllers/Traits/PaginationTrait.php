<?php


namespace App\Http\Controllers\Traits;

/**
 * Trait PaginationTrait
 * @package App\Http\Controllers\Traits
 */
trait PaginationTrait
{
    /**
     * @return int
     */
    public function getPage()
    {
        return ($this->request->page) ?: 1;
    }

    /**
     * @return int
     */
    public function getShow()
    {
        return ($this->request->show) ?: 15;
    }
}
