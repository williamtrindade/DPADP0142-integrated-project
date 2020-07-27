<?php

namespace App\Http\Controllers\Traits;

use App\Http\Response\Response;
use App\Services\Base\ServiceInterface;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
/**
 * Trait CrudTrait
 * @package  App\Http\Controllers\Traits
 * @property ServiceInterface     $service
 * @property Request              $request
 * @property Response             $response
 * @method   string               getTransformer()
 * @author William Trindade<williamtrindade.contato@gmail.com>
 */
trait CrudTrait
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $data = $this->service->all();
        $transformer = $this->getTransformer();
        $transformedData = new $transformer($data);
        // dd($transformedData);
        return $this->response->collection(
            $transformedData
        );
    }

    public function create(Request $request)
    {

    }

    public function read(User $user)
    {

    }

    public function update(Request $request, User $user)
    {

    }

    public function delete(User $user)
    {

    }
}
