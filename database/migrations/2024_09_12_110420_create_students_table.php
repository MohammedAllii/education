<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id(); 
            $table->string('full_name'); 
            $table->date('date_of_birth'); 
            $table->enum('gender', ['male', 'female']); 
            $table->string('address'); 
            $table->string('parent_name'); 
            $table->string('parent_phone'); 
            $table->string('parent_email')->nullable(); 
            $table->date('enrollment_date'); 
            $table->foreignId('class_id')->nullable()->constrained()->onDelete('cascade'); 
            $table->enum('status', ['active', 'transferred', 'suspended']); 
            $table->string('avatar')->default('student.png'); 
            $table->text('medical_notes')->nullable();
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
