<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\Controller;
use App\Http\Response\Response;
use App\Services\InviteEmployeeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class EmployeesController
 * @package App\Http\Controllers
 */
class EmployeesController extends Controller
{
    /** @var Request $request*/
    private $request;

    /** @var Response $response*/
    private $response;

    /** @var InviteEmployeeService $service */
    private $service;

    /**
     * EmployeesController constructor.
     * @param Request $request
     * @param Response $response
     * @param InviteEmployeeService $service
     */
    public function __construct(Request $request, Response $response, InviteEmployeeService $service)
    {
        $this->request = $request;
        $this->service = $service;
        $this->response = $response;
    }

    /**
     * @return JsonResponse
     */
    public function inviteEmployee()
    {
        $this->request->merge(['user' => $this->request->user()]);
        $this->service->inviteEmployee($this->request->all());
        return $this->response->withAccepted();
    }
}
