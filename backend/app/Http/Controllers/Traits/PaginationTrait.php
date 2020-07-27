<?php


namespace App\Http\Controllers\Traits;

/**
 * Trait PaginationTrait
 * @package App\Http\Controllers\Traits
 */
trait PaginationTrait
{
    public function paginate()
    {
        $page = $this->request->query('page', 1);
        $show = $this->request->query('show', 15);
        $this->service->paginate($page, $show);
    }
}