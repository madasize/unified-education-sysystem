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
        Schema::table('schools', function (Blueprint $table) {
            $table->string('region')->nullable()->after('name');
            $table->string('district')->nullable()->after('region');
            $table->string('school_type')->nullable()->after('district');
            $table->string('gender')->nullable()->after('school_type');
            $table->string('ownership')->nullable()->after('gender');
            $table->string('source')->nullable()->after('ownership');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schools', function (Blueprint $table) {
            $table->dropColumn(['region', 'district', 'school_type', 'gender', 'ownership', 'source']);
        });
    }
};
