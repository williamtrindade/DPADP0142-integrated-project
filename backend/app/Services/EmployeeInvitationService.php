<?php

namespace App\Services;

use App\Mail\InviteEmployeeMail;
use App\Models\EmployeeInvitation;
use App\Models\User;
use App\Repositories\EmployeeInvitation\EmployeeInvitationRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class EmployeeInvitationService
 * @package App\Services
 */
class EmployeeInvitationService
{
    /** @var EmployeeInvitationRepositoryInterface */
    private $repository;

    public function __construct(EmployeeInvitationRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @return void
     */
    public function inviteEmployee(array $data)
    {
        if (!validMail($data['email'])) {
           throw new UnprocessableEntityHttpException('E-mail inválido');
        }
        Mail::send(
            new InviteEmployeeMail(
                $data['user'],
                $data['email'],
                $this->generateEmployeeInvite($data['user'])
            )
        );
    }

    /**
     * @param User $user
     * @return EmployeeInvitation
     */
    private function generateEmployeeInvite(User $user): EmployeeInvitation
    {
        return EmployeeInvitation::create([
            'user_id' => $user->id,
            'hash' => Hash::make($user->created_at),
        ]);
    }

    /**
     * @param string $hash
     * @return void
     */
    public function validateHash(string $hash)
    {
        if (!$this->repository->validateHash($hash)) {
            throw new UnprocessableEntityHttpException('Hash inválida');
        }
    }
}
