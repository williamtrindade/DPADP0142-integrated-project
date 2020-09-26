<?php

namespace App\Filters;

use App\Filters\Base\FilterInterface;

class UserFilter implements FilterInterface
{
    public function getFilters(): array
    {
        return [
            'name'       => 'like',
            'permission' => 'equal',
        ];
    }
}
    
