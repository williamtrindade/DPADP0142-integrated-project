<?php

namespace App\Http\Transformers;

use App\Http\Transformers\Base\Transformer;
use Illuminate\Http\Request;

/**
 * Class UserTransformer
 * @package App\Http\Resources
 */
class UserTransformer extends Transformer
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
        ];
    }
}
