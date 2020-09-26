<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\Controller;
use App\Http\Controllers\Traits\CrudTrait;
use App\Http\Response\Response;
use App\Services\WorkingHourService;
use Illuminate\Http\Request;

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
}
