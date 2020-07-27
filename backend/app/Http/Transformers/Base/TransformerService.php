<?php

namespace App\Http\Transformers\Base;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

/**
 * Class TransformerService
 * @package App\Http\Transformers\Base
 * @author William Trindade <williamtrindade.contato@gmail.com>
 */
class TransformerService
{
    /**
     * @param $data
     * @param null $transformer
     * @return mixed|null
     */
    public function transform($data, $transformer = null)
    {
        return $transformer ?: $this->fetchDefaultTransformer($data);
    }

    /**
     * @param $data
     * @return mixed
     */
    private function fetchDefaultTransformer($data)
    {
        $classname = $this->getClassnameFrom($data);
        if ($this->hasDefaultTransformer($classname)) {
            $transformer = config('api.transformers.' . $classname);
            return new $transformer($data);
        }
        return null;
    }

    /**
     * @param $object
     * @return false|string|null
     */
    private function getClassnameFrom($object)
    {
        if ($object instanceof LengthAwarePaginator || $object instanceof Collection) {
            $first = Arr::first($object);
            return $first ? get_class($first) : null;
        }

        return get_class($object);
    }

    /**
     * @param string|null $classname
     * @return bool
     */
    private function hasDefaultTransformer(?string $classname)
    {
        return ! is_null(config('api.transformers.' . $classname));
    }
}