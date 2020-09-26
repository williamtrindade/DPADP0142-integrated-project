<?php

use App\Models\Account;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_blocks', function (Blueprint $table) {
            $table->id();

            $table->time('start_hour');
            $table->time('end_hour');
            $table->string('week_days');

            // Working Hour ID
            $table->unsignedBigInteger('working_hour_id');
            $table->foreign('working_hour_id')
                ->references('id')
                ->on('working_hours')
                ->onDelete('CASCADE');

            // Account ID
            $table->unsignedBigInteger('account_id');
            $table->foreign('account_id')
                ->references('id')
                ->on((new Account())->getTable())
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
        Schema::dropIfExists('time_blocks');
    }
}
