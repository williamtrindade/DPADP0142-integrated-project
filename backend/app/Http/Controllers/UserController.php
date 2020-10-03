<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\Controller;
use App\Http\Controllers\Traits\CrudTrait;
use App\Http\Controllers\Traits\PaginationTrait;
use App\Http\Response\Response;
use App\Scopes\AccountScope;
use App\Services\UserService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Throwable;

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
    public function index(): JsonResponse
    {
        $data = $this->service
            ->filter($this->request->query())
            ->addScope(new AccountScope($this->request->user()->account_id))
            ->all(true, $this->getPage(), $this->getShow());
        return $this->response->collection($data);
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws Exception
     */
    public function read(int $id): JsonResponse
    {
        $data = $this->service
            ->addScope(new AccountScope($this->request->user()->account_id))
            ->read($id);
        return $this->response->item($data);
    }

    /**
     * @return JsonResponse
     * @throws Exception
     */
    public function getMe(): JsonResponse
    {
        return $this->response->item($this->request->user());
    }

    /**
     * @return JsonResponse
     * @throws Exception
     */
    public function updateMe(): JsonResponse
    {
        $data = $this->request->all();
        $returned_data = $this->service->update($data, $this->request->user()->id);
        return $this->response->item($returned_data);
    }

    /**
     * @return JsonResponse
     * @throws ValidationException
     * @throws Exception
     */
    public function createByInvitationHash(): JsonResponse
    {
        $user = $this->service->createByInvitationHash($this->request->all());
        return $this->response->withCreated($user);
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws Exception
     */
    public function delete(int $id): JsonResponse
    {
        $this->service->addScope(new AccountScope($this->request->user()->account_id));
        $this->service->delete($id);
        return $this->response->withNoContent();
    }

    /**
     * @param int $userId
     * @param int $workingHourId
     * @return JsonResponse
     * @throws Throwable
     */
    public function updateWorkingHour(int $userId, int $workingHourId): JsonResponse
    {
        $this->service->addScope(new AccountScope($this->request->user()->account_id));
        $this->service->updateWorkingHour($userId, $workingHourId);
        return $this->response->json();
    }
}
