<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('repartidor_id')->nullable()->after('status');
            $table->text('admin_notes')->nullable()->after('repartidor_id');

            $table->foreign('repartidor_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['repartidor_id']);
            $table->dropColumn(['repartidor_id', 'admin_notes']);
        });
    }
};
