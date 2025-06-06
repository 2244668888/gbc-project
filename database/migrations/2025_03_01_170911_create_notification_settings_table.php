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
        Schema::create('notification_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->text('sub_title')->nullable();
            $table->string('key')->nullable();
            $table->enum('type', ['admin', 'customer', 'restaurant', 'deliveryman'])->default('admin');
            $table->enum('mail_status', ['active', 'inactive', 'disable'])->default('disable');
            $table->enum('sms_status', ['active', 'inactive', 'disable'])->default('disable');
            $table->enum('push_notification_status', ['active', 'inactive', 'disable'])->default('disable');
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
        Schema::dropIfExists('notification_settings');
    }
};
