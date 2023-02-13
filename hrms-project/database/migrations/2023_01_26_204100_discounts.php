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
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete("NO ACTION");
            $table->date("discount_date");
            $table->boolean("loan")->nullable();
            $table->boolean("absence")->nullable();
            $table->boolean("late")->nullable();
            $table->boolean("early_leaving")->nullable();
            $table->integer("discount_amount");
            $table->text("discount_details");
            
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discounts');
    }
};
