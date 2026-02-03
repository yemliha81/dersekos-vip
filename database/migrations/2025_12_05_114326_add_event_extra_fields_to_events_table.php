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
        Schema::table('events', function (Blueprint $table) {
            $table->boolean('is_free')->default(true)->after('meet_url');
            $table->decimal('price', 10, 2)->nullable()->after('is_free');
            $table->unsignedInteger('min_person')->nullable()->after('price');
            $table->unsignedInteger('max_person')->nullable()->after('min_person');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            //
        });
    }
};
