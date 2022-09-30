<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('sure_name')->nullable();
            $table->string('email')->unique();
            $table->enum('user_role',['administrator','user']);
            $table->enum('gender',['M','F'])->nullable();
            $table->string('place_of_birth')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->text('address')->nullable();
            $table->string('graduation_year')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('parent_phone_number')->nullable();
            $table->string('formal_education')->nullable();
            $table->string('study_program')->nullable();
            $table->string('class')->nullable();
            $table->string('semester')->nullable();
            $table->string('learning_program')->nullable();
            $table->string('program_institution')->nullable();
            $table->string('photo')->nullable();
            $table->string('proof_of_payment')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_active')->default(true);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
