<?php

namespace App\Mail;

use App\Models\EmployeeInvitation;
use App\Models\User;
use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InviteEmployeeMail extends Mailable
{
    use Queueable, SerializesModels;

    /** @var User $user */
    private $user;

    /** @var string $email */
    private $email;

    /** @var EmployeeInvitation $employeeInvite */
    private $employeeInvite;

    /**
     * Create a new message instance.
     *
     * @param User $user $user
     * @param string $email
     * @param EmployeeInvitation $employeeInvite
     */
    public function __construct(User $user, string $email, EmployeeInvitation $employeeInvite)
    {
        $this->user           = $user;
        $this->email          = $email;
        $this->employeeInvite = $employeeInvite;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('ponto@gmail.com')
            ->to($this->email)
            ->subject('Finalize seu cadastro no .Ponto')
            ->view('emails.invite-employee')
            ->with([
                'account_name' => $this->user->account->name,
                'user_name'    => $this->user->name,
                'vue_url'      => config('app.vue_url') .
                                  '/employee/register?hash=' .
                                  $this->employeeInvite->hash .
                                  '&email=' . $this->email,
            ]);
    }
}
