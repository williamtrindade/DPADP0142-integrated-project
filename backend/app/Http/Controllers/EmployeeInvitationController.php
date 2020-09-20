<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\Controller;
use App\Http\Response\Response;
use App\Services\EmployeeInvitationService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

/**
 * Class EmployeeInvitationController
 * @package App\Http\Controllers
 */
class EmployeeInvitationController extends Controller
{
    /** @var Request $request*/
    private $request;

    /** @var Response $response*/
    private $response;

    /** @var EmployeeInvitationService $service */
    private $service;

    /**
     * EmployeeInvitationController constructor.
     * @param Request $request
     * @param Response $response
     * @param EmployeeInvitationService $service
     */
    public function __construct(Request $request, Response $response, EmployeeInvitationService $service)
    {
        $this->request = $request;
        $this->service = $service;
        $this->response = $response;
    }

    /**
     * @return JsonResponse
     */
    public function inviteEmployee(): JsonResponse
    {
        $this->request->merge(['user' => $this->request->user()]);
        $this->service->inviteEmployee($this->request->all());
        return $this->response->withAccepted();
    }

    /**
     * @return JsonResponse
     * @throws Exception
     */
    public function validateHash(): JsonResponse
    {
        $this->service->validateHash(Arr::get($this->request->all(), 'hash', ''));
        return $this->response->item(['hash' => $this->request['hash']]);
    }
}
