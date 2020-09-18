<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateEmployeeInvitesTable
 */
class CreateEmployeeInvitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_invites', function (Blueprint $table) {
            $table->id();
            $table->string('hash');
            // Account ID
            $table->unsignedBigInteger('account_id');
            $table->foreign('user_id')
                ->references('id')
                ->on((new User())->getTable())
                ->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_invites');
    }
}
