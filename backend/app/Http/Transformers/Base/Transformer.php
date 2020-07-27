<?php

namespace App\Http\Transformers\Base;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;


/**
 * Class Transformer
 * @package App\Http\Resources\Base
 * @property  AnonymousResourceCollection $resource
 */
abstract class Transformer extends JsonResource implements TransformerInterface
{
//    public function __construct($resource)
//    {
//        return parent::__construct($resource);
//        if ($resource instanceof Collection) {
//            /** @var $resource Collection */
//            return $this->getCollection($resource);
//        }
//        return $this->getItem($this->resource);
//    }
//
//    /**
//     * @param mixed $resource
//     * @return array
//     */
//    public function getCollection($resource): array
//    {
//        return (array) parent::collection(
//            $resource
//        )->response()->getData();
//    }
//
//    /**
//     * @param $resource
//     * @return mixed
//     */
//    public function getItem($resource)
//    {
//        return $resource;
//    }
}
