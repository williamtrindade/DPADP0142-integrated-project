<?php

namespace App\Services;

use App\Mail\InviteEmployeeMail;
use App\Models\EmployeeInvitation;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class InviteEmployeeService
 * @package App\Services
 */
class InviteEmployeeService
{
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

    public function validateHash(array $data)
    {
        if (Arr::get($data, 'hash', false)) {

        } else {
            throw new UnprocessableEntityHttpException('Hash inválida');
        }
    }
}
