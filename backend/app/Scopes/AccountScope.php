<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

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
     * @param Model|Builder $builder
     * @return Builder
     */
    public function apply($builder): Builder
    {
        return $builder->where('account_id', '=', $this->account_id);
    }
}
