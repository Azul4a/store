<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        try {
            DB::statement('
                CREATE TABLE categories (
                    id bigint UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
                    name varchar(255) NOT NULL,
                    description varchar(255) NULL DEFAULT NULL,
                    created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    updated_at timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP
                );
            ');
        } catch (\Throwable $t) {
            echo $t->getMessage();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        try {
            DB::statement('DROP TABLE categories');
        } catch (\Throwable $t) {
            echo $t->getMessage();
        }
    }
};
