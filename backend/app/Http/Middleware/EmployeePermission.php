<?php

namespace App\Http\Middleware;

use App\Http\Response\Response;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

/**
 * Class EmployeePermission
 * @package App\Http\Middleware
 */
class EmployeePermission
{
    /** @var Response $response */
    private $response;

    /**
     * ManagerPermission constructor.
     * @param Response $response
     */
    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->permission != User::EMPLOYEE_PERMISSION) {
            return $this->response->withForbidden('Você não tem permissão para acessar esse recurso');
        }
        return $next($request);
    }
}
