<?php

namespace App\Http\Response;

use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\Collection as BaseCollection;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

/**
 * Class Response
 * @package App\Http
 * @author William Trindade <williamtrindade.contato@gmail.com>
 */
class Response
{
    /** @var ResponseFactory $response */
    private $response;

    /** @var int $statusCode */
    private $statusCode = HttpResponse::HTTP_OK;

    /**
     * Response constructor.
     * @param ResponseFactory $response
     */
    public function __construct(ResponseFactory $response)
    {
        $this->response = $response;
    }

    /**
     * @param $item
     * @return JsonResponse
     */
    public function withCreated(array $item = null): JsonResponse
    {
        $this->setStatusCode(HttpResponse::HTTP_CREATED);

        if (null != $item) {
            return $this->json();
        }

        return $this->json([
            'success' => true,
            'message' => JsonResponse::$statusTexts[JsonResponse::HTTP_CREATED],
            'data' => $item
        ]);
    }

    /**
     * @param string|null $message
     * @param null $data
     * @return JsonResponse
     */
    public function withUnprocessableEntity(string $message = null, $data = null): JsonResponse
    {
        return $this->setStatusCode(HttpResponse::HTTP_UNPROCESSABLE_ENTITY)->json([
            'success' => false,
            'message' => $message ?? JsonResponse::$statusTexts[ JsonResponse::HTTP_UNPROCESSABLE_ENTITY ],
            'data' => $data ?? [],
        ]);
    }

    /**
     * @param string|null $message
     * @param null $data
     * @return JsonResponse
     */
    public function withAccepted(string $message = null, $data = null): JsonResponse
    {
        return $this->setStatusCode(HttpResponse::HTTP_ACCEPTED)->json([
            'success' => true,
            'message' => $message ?? JsonResponse::$statusTexts[JsonResponse::HTTP_ACCEPTED],
            'data'    => $data ?? [],
        ]);
    }

    /**
     * @param string $message
     * @return JsonResponse
     */
    public function withTooManyRequests($message = 'Too Many Requests'): JsonResponse
    {
        return $this->setStatusCode(HttpResponse::HTTP_TOO_MANY_REQUESTS)->withError($message);
    }

    /**
     * @param string $message
     * @return JsonResponse
     */
    public function withUnauthorized($message = 'Unauthorized')
    {
        return $this->setStatusCode(HttpResponse::HTTP_UNAUTHORIZED)->withError($message);
    }

    /**
     * @param string $message
     * @return JsonResponse
     */
    public function withForbidden($message = 'Forbidden'): JsonResponse
    {
        return $this->setStatusCode(HttpResponse::HTTP_FORBIDDEN)->withError($message);
    }

    /**
     * @param string $message
     * @return JsonResponse
     */
    public function withInternalServerError($message = 'Internal Server Error'): JsonResponse
    {
        return $this->setStatusCode(HttpResponse::HTTP_INTERNAL_SERVER_ERROR)->withError($message);
    }

    /**
     * @param string $message
     * @return JsonResponse
     */
    public function withNotFound($message = 'Not Found'): JsonResponse
    {
        return $this->setStatusCode(HttpResponse::HTTP_NOT_FOUND)->withError($message);
    }

    /**
     * @return JsonResponse
     */
    public function withNoContent(): JsonResponse
    {
        return $this->setStatusCode(HttpResponse::HTTP_NO_CONTENT)->json();
    }

    /**
     * @param $message
     * @return JsonResponse
     */
    public function withError($message)
    {
        return $this->json([
            'success' => false,
            'message' => (is_array($message) ? $message : [$message]),
        ]);
    }

    /**
     * @param mixed $item
     * @return JsonResponse
     * @throws Exception
     */
    public function item($item): JsonResponse
    {
        if (( $item instanceof Model ) || ( is_array($item) )) {
            return $this->json([
                'success' => true,
                'message' => JsonResponse::$statusTexts[JsonResponse::HTTP_OK],
                'data' => $item
            ]);
        } else {
            throw new Exception('The [item] parameter must be an array or [Illuminate\Database\Eloquent\Model]');
        }
    }

    /**
     * @param mixed $items
     * @return JsonResponse
     * @throws Exception
     */
    public function collection($items): JsonResponse
    {
        if (( $items instanceof BaseCollection)       ||
            ( $items instanceof Collection)           ||
            ( $items instanceof LengthAwarePaginator) ||
            ( is_array($items) )
        ) {
            return $this->json(array_merge([
                'success' => true,
                'message' => JsonResponse::$statusTexts[JsonResponse::HTTP_OK],
            ], ['data' => $items] ));
        } else {
            throw new Exception(
                'The [items] parameter must be an array,
                [\Illuminate\Database\Eloquent\Collection],
                [Illuminate\Support\Collection] or
                [Illuminate\Contracts\Pagination\LengthAwarePaginator]'
            );
        }
    }

    /**
     * @param array $data
     * @param array $headers
     * @return JsonResponse
     */
    public function json($data = [], array $headers = []): JsonResponse
    {
        return $this->response->json($data, $this->statusCode, $headers);
    }

    /**
     * @param array $data
     * @param array $headers
     * @return JsonResponse
     */
    public function jsonData($data = [], array $headers = []): JsonResponse
    {
        return $this->response->json([
            'success' => true,
            'message' => JsonResponse::$statusTexts[JsonResponse::HTTP_OK],
            'data'    => $data
        ], $this->statusCode, $headers);
    }

    /**
     * @param $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode): self
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
