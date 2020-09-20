<?php

namespace App\Repositories\EmployeeInvitation;

use App\Models\Account;

interface EmployeeInvitationRepositoryInterface
{
    public function validateHash(string $hash): bool;
    public function getAccountByHash(string $hash): Account;
}
