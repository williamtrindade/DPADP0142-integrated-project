<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\Controller;
use App\Http\Controllers\Traits\CrudTrait;
use App\Http\Controllers\Traits\PaginationTrait;
use App\Http\Response\Response;
use App\Services\UserService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    use CrudTrait;
    use PaginationTrait;

    /** @var UserService $service */
    private $service;

    /** @var Request $request */
    private $request;

    /** @var Response */
    private $response;

    /**
     * UserController constructor.
     * @param UserService $service
     * @param Request $request
     * @param Response $response
     */
    public function __construct(UserService $service, Request $request, Response $response)
    {
        $this->service = $service;
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * @return JsonResponse
     * @throws Exception
     */
    public function getMe()
    {
        return $this->response->item($this->request->user());
    }

    /**
     * @return JsonResponse
     * @throws Exception
     */
    public function updateMe()
    {
        $data = $this->request->all();
        $returned_data = $this->service->update($data, $this->request->user()->id);
        return $this->response->item($returned_data);
    }
}
