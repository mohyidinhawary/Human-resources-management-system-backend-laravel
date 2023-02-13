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
        
        Schema::create('mail_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete("NO ACTION");
            $table->string('first_name');
            $table->boolean('vacation')->nullable();
            $table->boolean('transfer')->nullable();
            $table->boolean('promotion')->nullable();
            $table->boolean('complaining')->nullable();
            $table->boolean('resignation')->nullable();
            $table->string('subject');

            $table->text('details');
            $table->boolean('accepted')->nullable();
            
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mail_services'); 
    }
};
