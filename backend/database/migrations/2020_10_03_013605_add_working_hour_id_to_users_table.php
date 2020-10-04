<?php

use App\Models\WorkingHour;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class AddWorkingHourIdToUsersTable
 */
class AddWorkingHourIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Working hour ID
            $table->unsignedBigInteger('working_hour_id')->nullable();
            $table->foreign('working_hour_id')
                ->references('id')
                ->on((new WorkingHour())->getTable())
                ->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['working_hour_id']);
        });
    }
}
