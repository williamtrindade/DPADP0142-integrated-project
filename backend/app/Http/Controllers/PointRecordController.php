<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\Controller;
use App\Http\Controllers\Traits\CrudTrait;
use App\Http\Controllers\Traits\PaginationTrait;
use App\Http\Response\Response;
use App\Models\PointRecord;
use App\Scopes\AccountScope;
use App\Scopes\UserScope;
use App\Services\PointRecordService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PointRecordController extends Controller
{
    use CrudTrait;
    use PaginationTrait;

    /** @var PointRecordService $service */
    private $service;

    /** @var Request $request */
    private $request;

    /** @var Response */
    private $response;

    public function __construct(PointRecordService $service, Request $request, Response $response)
    {
        $this->service = $service;
        $this->request = $request;
        $this->response = $response;
    }

    public function index(): JsonResponse
    {
        $data = $this->service
            ->filter($this->request->query())
            ->addScope(new UserScope($this->request->user()->id))
            ->all(true, $this->getPage(), $this->getShow());
        return $this->response->collection($data);
    }

    public function create(): JsonResponse
    {
        $this->request->merge([
            'account_id' => $this->request->user()->account_id,
            'user_id'    => $this->request->user()->id,
        ]);
        $data = $this->service->create($this->request->all());
        return $this->response->item($data);
    }

    /**
     * @throws ValidationException
     * @throws Exception
     */
    public function approve(int $id): JsonResponse
    {
        $data = $this->service->update([
            'account_id' => $this->request->user()->account_id,
            'user_id'    => $this->request->user()->id,
            'status'     => PointRecord::APPROVED_STATUS
        ], $id);
        return $this->response->item($data);
    }

    /**
     * @throws ValidationException
     * @throws Exception
     */
    public function unapprove(int $id): JsonResponse
    {
        $data = $this->service->update([
            'account_id' => $this->request->user()->account_id,
            'user_id'    => $this->request->user()->id,
            'status'     => PointRecord::REPROVED_STATUS
        ], $id);
        return $this->response->item($data);
    }

    /**
     * @throws Exception
     */
    public function getAllUnapproved(): JsonResponse
    {
        $data = $this->service
            ->filter($this->request->query())
            ->addScope(new AccountScope($this->request->user()->account_id))
            ->allUnapproved(true, $this->getPage(), $this->getShow());
        return $this->response->collection($data);
    }
}
