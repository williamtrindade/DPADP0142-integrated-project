<?php

namespace App\Http\Transformers\Base;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class Transformer
 * @package App\Http\Resources\Base
 * @property  AnonymousResourceCollection $resource
 */
abstract class Transformer extends JsonResource
{
    /**
     * Transformer constructor.
     * @param $resource
     */
    public function __construct($resource)
    {
        parent::__construct($resource);
        if (
            ( $resource instanceof \Illuminate\Database\Eloquent\Collection ) ||
            ( $resource instanceof LengthAwarePaginator ) ||
            ( $resource instanceof \Illuminate\Support\Collection) ||
            ( $resource instanceof AnonymousResourceCollection) ||
            ( is_array($resource) )
        ) {
            $data = parent::collection($resource)->response()->getData();
            if( is_array($data) ) {
                return $data;
            }
            return (array) $data;

        }
        return null;
    }
}
