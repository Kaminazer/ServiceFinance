<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table("users", function (Blueprint $table) {
            $table->bigInteger("default_currency")->unsigned()->after('email_verified_at')->default(1);
            $table->foreign("default_currency")->references("id")->on("currencies");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['default_currency']);
            $table->dropColumn('default_currency');
        });
    }
};
