<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Ensure required tables exist
        if (!Schema::hasTable('users')) {
            throw new \Exception('Users table does not exist. Please run the users migration first.');
        }
        if (!Schema::hasTable('courses')) {
            throw new \Exception('Courses table does not exist. Please run the courses migration first.');
        }

        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->string('status');
            $table->string('payment_method');
            $table->decimal('amount_paid', 8, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('enrollments');
    }
}; 