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
        Schema::table('posts', function (Blueprint $table) {
            $table->string('province')->after('image');
            $table->string('difficulty')->after('province');
            $table->decimal('longitude', 5, 2)->after('difficulty');
            $table->integer('altitude')->nullable()->after('longitude');
            $table->time('time')->nullable()->after('altitude');
            $table->string('track')->nullable()->after('time');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['province', 'difficulty', 'longitude', 'altitude', 'time', 'track']);
        });
    }
};
