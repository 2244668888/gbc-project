<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incentive_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('delivery_man_id');
            $table->unsignedBigInteger('zone_id');
            $table->decimal('earning', 23, 3)->default(0);
            $table->decimal('incentive', 23, 3)->default(0);
            $table->date('date')->nullable();
            $table->decimal('today_earning', 23, 3)->default(0);
            $table->decimal('working_hours', 23, 3)->default(0);
            $table->string('status')->nullable();
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
        Schema::dropIfExists('incentive_logs');
    }
};
