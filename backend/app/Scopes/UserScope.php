<?php

namespace App\Scopes;

use App\Scopes\Base\ScopeInterface;
use Illuminate\Database\Eloquent\Builder;

class UserScope implements ScopeInterface
{
    private $user_id;

    public function __construct(int $user_id)
    {
        $this->user_id = $user_id;
    }

    public function apply($builder): Builder
    {
        return $builder->where('user_id', '=', $this->user_id);
    }
}
