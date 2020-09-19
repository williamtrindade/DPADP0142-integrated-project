<?php

namespace App\Services;

use App\Mail\InviteEmployeeMail;
use App\Models\EmployeeInvite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
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
     * @return EmployeeInvite
     */
    private function generateEmployeeInvite(User $user): EmployeeInvite
    {
        return EmployeeInvite::create([
            'user_id' => $user->id,
            'hash' => Hash::make($user->created_at),
        ]);
    }
}
