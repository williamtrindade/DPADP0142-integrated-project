<?php

use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserSeeder
 */
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        /** @var Account $account */
        $account = Account::create([
            'name'       => 'Ponto Web',
            'cnpj'       => '12345678989',
            'address'    => 'Address',
            'cep'        => '12345678989',
            'manager_id' => null,
            'phone'      => '55981215178',
        ]);
        /** @var User $user */
        $user = User::create([
            'name'       => 'William (Admin)',
            'email'      => 'williamtrindade777@gmail.com',
            'password'   => Hash::make('laravel'),
            'permission' => User::MANAGER_PERMISSION,
            'cpf'        => '03899083814',
            'phone'      => '03899083040',
            'account_id' => $account->id,
        ]);
        $account->update([
            'manager_id' => $user->id,
        ]);
        factory(User::class, 20)->create([
            'account_id' => $account->id
        ]);
    }
}
