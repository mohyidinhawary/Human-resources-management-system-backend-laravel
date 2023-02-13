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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string("first_name");
            $table->string("middle_name");
            $table->string("last_name");
            $table->string("email")->unique();
            $table->string("password");
            $table->string("university");
            $table->string("phone_number");
            $table->date("birth_day");
            $table->string("city");
            $table->string("branch");
            $table->date("date_of_job");
            $table->string("bank_account_name")->nullable();
            $table->text("bank_account_details")->nullable();
            $table->string("certifcates");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
};
