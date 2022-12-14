<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLarapayTransactionTable extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('larapay_transactions', function (Blueprint $table) {

            //primary key
            $table->increments('id');

            //morph to model like order or user
            $table->morphs('model');

            //status
            $table->boolean('accomplished')->default(false);
            $table->boolean('verified')->default(false);
            $table->boolean('after_verified')->default(false);
            $table->boolean('reversed')->default(false);
            $table->boolean('submitted')->default(false);
            $table->boolean('approved')->default(false);
            $table->boolean('rejected')->default(false);

            $table->string('payment_method', 255)->default('ONLINE');

            $table->string('bank_order_id', 20)->nullable(); // gateway order ID

            $table->string('gate_name', 20)->nullable();
            $table->string('gate_refid', 40)->nullable();
            $table->string('gate_status')->nullable();

            $table->text('description')->nullable();
            $table->bigInteger('amount')->default(0);
            $table->jsonb('extra_params')->nullable();
            $table->jsonb('additional_data')->nullable();
            $table->jsonb('sharing')->nullable();

            $table->dateTime('paid_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('larapay_transactions');
    }
}
