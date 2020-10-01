<?php

namespace App\Filters;

use App\Filters\Base\FilterInterface;

class WorkingHourFilter implements FilterInterface
{
    public function getFilters(): array
    {
        return [];
    }
}
