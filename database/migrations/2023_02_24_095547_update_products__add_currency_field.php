<?php

use App\Models\Currency;
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
        Schema::table('products', function(Blueprint $table) {
            $table->char('currency_name', 3)
                ->nullable();

            $table->foreign('currency_name')
                ->references('name')
                ->on('currencies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function(Blueprint $table) {
            $table->dropForeign('products_currency_name_foreign');
            $table->dropColumn('currency_name');
        });
    }
};
