<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sponsorship_teacher', function (Blueprint $table) {
            $table->foreignId('sponsorship_id')->constrained();
            $table->foreignId('teacher_id')->constrained();
            $table->timestamp('expire_date')->nullable();
            $table->timestamp('start_date')->nullable();
        });

        Schema::table('subject_teacher', function (Blueprint $table) {
            $table->foreignId('subject_id')->constrained();
            $table->foreignId('teacher_id')->constrained();
            
        });

        Schema::table('rating_teacher', function (Blueprint $table) {
            $table->foreignId('rating_id')->constrained();
            $table->foreignId('teacher_id')->constrained();
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->foreignId('teacher_id')->constrained();
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->foreignId('teacher_id')->constrained();
        });

        Schema::table('teachers', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
        });

       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sponsorship_teacher', function (Blueprint $table) {
            $table->dropForeign(['sponsorship_id']);
            $table->dropColumn(['sponsorship_id']);
            $table->dropForeign(['teacher_id']);
            $table->dropColumn(['teacher_id']);
            $table->dropColumn('expire_date');
            $table->dropColumn('start_date');
            
        });

        Schema::table('subject_teacher', function (Blueprint $table) {
            $table->dropForeign(['subject_id']);
            $table->dropColumn(['subject_id']);
            $table->dropForeign(['teacher_id']);
            $table->dropColumn(['teacher_id']);
        });

        Schema::table('rating_teacher', function (Blueprint $table) {
            $table->dropForeign(['rating_id']);
            $table->dropColumn(['rating_id']);
            $table->dropForeign(['teacher_id']);
            $table->dropColumn(['teacher_id']);
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign(['teacher_id']);
            $table->dropColumn(['teacher_id']);
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['teacher_id']);
            $table->dropColumn(['teacher_id']);
        });

        Schema::table('teachers', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id']);
        });

       
    }
};
