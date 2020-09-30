<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\Controller;
use App\Http\Controllers\Traits\CrudTrait;
use App\Http\Response\Response;
use App\Services\WorkingHourService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * Class WorkingHourController
 * @package App\Http\Controllers
 */
class WorkingHourController extends Controller
{
    use CrudTrait;

    /** @var WorkingHourService $service*/
    private $service;

    /** @var Request $request*/
    private $request;

    /** @var Response*/
    private $response;

    /**
     * WorkingHourController constructor.
     * @param WorkingHourService $service
     * @param Request            $request
     * @param Response           $response
     */
    public function __construct(WorkingHourService $service, Request $request, Response $response)
    {
        $this->service  = $service;
        $this->request  = $request;
        $this->response = $response;
    }

    /**
     * @return JsonResponse
     * @throws ValidationException
     * @throws Exception
     */
    public function create(): JsonResponse
    {
        $data = $this->service->create($this->request->all());
        return $this->response->item($data);
    }
}
