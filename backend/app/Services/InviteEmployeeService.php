<?php

namespace App\Services;

use App\Mail\InviteEmployeeMail;
use App\Models\EmployeeInvite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

/**
 * Class InviteEmployeeService
 * @package App\Services
 */
class InviteEmployeeService
{
    /**
     * @param array $data
     */
    public function inviteEmployee(array $data)
    {
        if (validMail($data['email'])) {
            Mail::send(
                new InviteEmployeeMail(
                    $data['user'],
                    $data['email'],
                    $this->generateEmployeeInvite($data['user'])
                )
            );
        }
    }

    /**
     * @param User $user
     * @return EmployeeInvite
     */
    private function generateEmployeeInvite(User $user): EmployeeInvite
    {
        return EmployeeInvite::create([
            'user' => $user->name,
            'hash' => Hash::make($user->created_at),
        ]);
    }
}
