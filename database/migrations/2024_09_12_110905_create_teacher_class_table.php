<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherClassTable extends Migration
{
    public function up()
    {
        Schema::create('teacher_class', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('class_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('teacher_class');
    }
}
