<?php

use App\Models\Account;
use App\Models\PointRecord;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreatePointRecordsTable
 */
class CreatePointRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_records', function (Blueprint $table) {
            $table->id();
            $table->string('lat');
            $table->string('lng');
            $table->tinyInteger('status')->default(PointRecord::ON_HOLD_STATUS);
            $table->tinyInteger('type');

            // User ID
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on((new User())->getTable())
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
        Schema::dropIfExists('point_records');
    }
}
