<?php

namespace App\Http\Controllers\Traits;

use App\Http\Response\Response;
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
    public function index(): JsonResponse
    {
        $data = $this->service->all(true, $this->getPage(), $this->getShow());
        return $this->response->collection($data);
    }

    /**
     * @return JsonResponse
     * @throws Exception
     */
    public function create(): JsonResponse
    {
        $data = $this->service->create($this->request->all());
        return $this->response->item($data);
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws Exception
     */
    public function read($id): JsonResponse
    {
        $data = $this->service->read($id);
        return $this->response->item($data);
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws Exception
     */
    public function update($id): JsonResponse
    {
        $data = $this->service->update($this->request->all(), $id);
        return $this->response->item($data);
    }

    public function delete()
    {

    }
}
