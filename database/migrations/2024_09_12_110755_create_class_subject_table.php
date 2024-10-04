<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassSubjectTable extends Migration
{
    public function up()
    {
        Schema::create('class_subject', function (Blueprint $table) {
            $table->id(); // ID unique de la relation
            $table->foreignId('class_id')->constrained(); // Référence vers la classe
            $table->foreignId('subject_id')->constrained(); // Référence vers la matière
            $table->timestamps(); // Champs created_at et updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('class_subject');
    }
}
