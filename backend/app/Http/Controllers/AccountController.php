<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\Controller;
use App\Http\Controllers\Traits\CrudTrait;
use App\Http\Controllers\Traits\PaginationTrait;
use App\Http\Response\Response;
use App\Services\AccountService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class AccountController
 * @package App\Http\Controllers
 */
class AccountController extends Controller
{
    use CrudTrait;
    use PaginationTrait;

    /** @var AccountService $service */
    private $service;

    /** @var Request $request */
    private $request;

    /** @var Response */
    private $response;

    /**
     * UserController constructor.
     * @param AccountService $service
     * @param Request $request
     * @param Response $response
     */
    public function __construct(AccountService $service, Request $request, Response $response)
    {
        $this->service  = $service;
        $this->request  = $request;
        $this->response = $response;
    }

    /**
     * Guest Create / Not Auth
     * @return JsonResponse
     * @throws Exception
     */
    public function create()
    {
        $data = $this->service->create($this->request->all());
        return $this->response->item($data);
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws Exception
     */
    public function read(int $id): JsonResponse
    {
        if ($this->request->user()->account_id != $id) {
            return $this->response->withNotFound();
        }
        $data = $this->service->read($id);
        return $this->response->item($data);
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws Exception
     */
    public function update(int $id): JsonResponse
    {
        if ($this->request->user()->account_id != $id) {
            return $this->response->withNotFound();
        }
        $data = $this->service->update($this->request->all(), $id);
        return $this->response->item($data);
    }
}
