<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\Controller;
use App\Services\InviteEmployeeService;
use Illuminate\Http\Request;

/**
 * Class EmployeesController
 * @package App\Http\Controllers
 */
class EmployeesController extends Controller
{
    /** @var Request $request*/
    private $request;

    /** @var InviteEmployeeService $service */
    private $service;

    /**
     * EmployeesController constructor.
     * @param Request $request
     * @param InviteEmployeeService $service
     */
    public function __construct(Request $request, InviteEmployeeService $service)
    {
        $this->request = $request;
        $this->service = $service;
    }

    public function inviteEmployee()
    {
        $this->request->merge(['user' => $this->request->user()]);
        $this->service->inviteEmployee($this->request->all());
    }
}
