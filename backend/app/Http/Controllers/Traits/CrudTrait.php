<?php

namespace App\Http\Controllers\Traits;

use App\Http\Response\Response;
use App\Models\ModelInterface;
use App\Services\Base\ServiceInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Trait CrudTrait
 * @package  App\Http\Controllers\Traits
 * @property ServiceInterface     $service
 * @property Request              $request
 * @property Response             $response
 * @author William Trindade<williamtrindade.contato@gmail.com>
 */
trait CrudTrait
{
    /**
     * @return JsonResponse
     * @throws Exception
     */
    public function index()
    {
        $data = $this->service->all(true, $this->getPage(), $this->getShow());
        return $this->response->collection($data);
    }

    public function create(Request $request)
    {

    }

    public function read(ModelInterface $user)
    {

    }

    public function update(Request $request, ModelInterface $user)
    {

    }

    public function delete(ModelInterface $user)
    {

    }
}
