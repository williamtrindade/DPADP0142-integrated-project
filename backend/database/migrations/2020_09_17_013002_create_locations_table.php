<?php

use App\Models\Account;
use App\Models\PointRecord;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('lat');
            $table->string('lng');

            // Point Record ID
            $table->unsignedBigInteger('point_record_id')->nullable();
            $table->foreign('point_record_id')
                ->references('id')
                ->on((new PointRecord())->getTable())
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
        Schema::dropIfExists('locations');
    }
}
