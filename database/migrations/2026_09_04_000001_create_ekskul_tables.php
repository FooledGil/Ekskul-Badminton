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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('registration_code')->unique();
            $table->string('name');
            $table->string('class_major');
            $table->string('whatsapp_number');
            $table->string('gender')->default('L');
            $table->string('preferred_category')->default('Tunggal Putra');
            $table->string('experience_level')->default('Pemula');
            $table->text('motivation');
            $table->string('status')->default('menunggu'); // menunggu, diterima, ditolak
            $table->text('coach_notes')->nullable();
            $table->timestamps();
        });

        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('day');
            $table->string('time_range');
            $table->string('location');
            $table->string('focus');
            $table->boolean('is_next')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category_name');
            $table->integer('year')->default(2025);
            $table->string('rank')->default('Juara 1');
            $table->string('medal_type')->default('gold'); // gold, silver, bronze
            $table->text('image_url')->nullable();
            $table->string('athlete_names')->nullable();
            $table->timestamps();
        });

        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('caption')->nullable();
            $table->string('category')->default('latihan'); // semua, tim, latihan, pertandingan
            $table->text('image_url');
            $table->string('span_class')->default('col-span-1');
            $table->timestamps();
        });

        Schema::create('match_scores', function (Blueprint $table) {
            $table->id();
            $table->string('tournament');
            $table->string('category');
            $table->string('team_a_name');
            $table->string('team_b_name');
            $table->integer('team_a_sets')->default(0);
            $table->integer('team_b_sets')->default(0);
            $table->string('score_details');
            $table->string('status')->default('selesai'); // live, selesai, mendatang
            $table->boolean('is_active_highlight')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('match_scores');
        Schema::dropIfExists('galleries');
        Schema::dropIfExists('achievements');
        Schema::dropIfExists('schedules');
        Schema::dropIfExists('registrations');
    }
};
