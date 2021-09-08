<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Base\Controller;
use App\Http\Response\Response;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    /** @var Request $request */
    private $request;

    /** @var Response $response*/
    private $response;

    /**
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * @throws Exception
     */
    public function reports(): JsonResponse
    {
        return $this->response->item([
            'new_employees'       => $this->newEmployees(),
            'new_employees_total' => array_sum($this->newEmployees())
        ]);
    }

    private function newEmployees(): array
    {
        return [
            'jan' => $this->getuserFromMonth(1),
            'fev' => $this->getuserFromMonth(2),
            'mar' => $this->getuserFromMonth(3),
            'abr' => $this->getuserFromMonth(4),
            'mai' => $this->getuserFromMonth(5),
            'jun' => $this->getuserFromMonth(6),
            'jul' => $this->getuserFromMonth(7),
            'ago' => $this->getuserFromMonth(8),
            'set' => $this->getuserFromMonth(9),
            'out' => $this->getuserFromMonth(10),
            'nov' => $this->getuserFromMonth(11),
            'dez' => $this->getuserFromMonth(12),
        ];
    }

    private function getUserFromMonth(int $month): int
    {
        $increment = 0;
        app(User::class)->where('account_id', $this->request->user()->account_id)->where('permission', 2)->each(function(User $user) use (
            &$increment,
            $month
        ) {
           if (Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->month === $month) {
               $increment ++;
           }
        });
        return $increment;
    }
}
