<?php

namespace App\Mail;

use App\Models\EmployeeInvite;
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

    /** @var EmployeeInvite $employeeInvite */
    private $employeeInvite;

    /**
     * Create a new message instance.
     *
     * @param User $user $user
     * @param string $email
     * @param EmployeeInvite $employeeInvite
     */
    public function __construct(User $user, string $email, EmployeeInvite $employeeInvite)
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
                'hash'         => $this->employeeInvite->hash,
                'vue_url'      => config('app.vue_url'),
            ]);
    }
}
