<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\Controller;
use App\Http\Controllers\Base\CrudInterface;
use App\Http\Controllers\Traits\CrudTrait;
use App\Http\Response\Response;
use App\Http\Transformers\UserTransformer;
use App\Services\UserService;
use Illuminate\Http\Request;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller implements CrudInterface
{
    use CrudTrait;

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
        $this->service->paginate();
    }

    public function getTransformer(): string
    {
        return UserTransformer::class;
    }
}
