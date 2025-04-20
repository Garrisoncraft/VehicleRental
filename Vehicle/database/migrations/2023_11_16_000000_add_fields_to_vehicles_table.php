<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->enum('type', ['sale', 'rent'])->default('sale')->after('price');
            $table->unsignedBigInteger('owner_id')->nullable()->after('type');
            $table->text('description')->nullable()->after('owner_id');

            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Set owner_id to null for existing records to avoid foreign key constraint errors
        DB::table('vehicles')->whereNull('owner_id')->update(['owner_id' => null]);
    }

    public function down()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropForeign(['owner_id']);
            $table->dropColumn(['type', 'owner_id', 'description']);
        });
    }
};
