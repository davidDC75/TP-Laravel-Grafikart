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
        Schema::table('properties', function (Blueprint $table) {
            /*
             * On peut aussi utiliser cette syntaxe :
             * $table->softDeletes();
             */
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        /*
         * On peut aussi utiliser cette syntaxe :
         * $table->dropSoftDeletes();
         */
        Schema::table('properties', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
