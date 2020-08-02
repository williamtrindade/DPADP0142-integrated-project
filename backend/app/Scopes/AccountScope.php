<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class AccountScope
 * @package App\Scopes
 */
class AccountScope implements ScopeInterface
{
    private $account_id;

    /**
     * AccountScope constructor.
     * @param $account_id
     */
    public function __construct($account_id)
    {
        $this->account_id = $account_id;
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function apply(Builder $builder): Builder
    {
        return $builder->where('id', '=', $this->account_id);
    }
}
