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
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete(); //constranied: khong truyen ten bang, cascadeOnDelete(): xoa hs thi hoac mon thi diem cx xoa
            $table->foreignId('subject_id')->constrained()->cascadeOnDelete();
            $table->decimal('score', 4, 2); //mot hoc sinh chi co mot dong diem
            $table->timestamps();

            $table->unique(['student_id','subject_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scores');
    }
};
