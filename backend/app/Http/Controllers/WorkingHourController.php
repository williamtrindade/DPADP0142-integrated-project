<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\Controller;
use App\Http\Controllers\Traits\CrudTrait;
use App\Http\Controllers\Traits\PaginationTrait;
use App\Http\Response\Response;
use App\Scopes\AccountScope;
use App\Services\WorkingHourService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class WorkingHourController
 * @package App\Http\Controllers
 */
class WorkingHourController extends Controller
{
    use CrudTrait;
    use PaginationTrait;

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
     * @return JsonResponse
     * @throws Exception
     */
    public function create(): JsonResponse
    {
        $this->request->merge([
            'account_id' => (int) $this->request->user()->account_id,
            'user_id'    => $this->request->user()->id
        ]);
        $data = $this->service->create($this->request->all());
        return $this->response->item($data);
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
     * @param int $id
     * @return JsonResponse
     * @throws Exception
     */
    public function read(int $id): JsonResponse
    {
        $this->service->addScope(new AccountScope($this->request->user()->account_id));
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
        $this->request->merge([
            'account_id' => (int) $this->request->user()->account_id,
            'user_id'    => $this->request->user()->id
        ]);
        $this->service->addScope(new AccountScope($this->request->user()->account_id));
        $data = $this->service->update($this->request->all(), $id);
        return $this->response->item($data);
    }
}
