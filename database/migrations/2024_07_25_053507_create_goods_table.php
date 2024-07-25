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
                CREATE TABLE products (
                    id bigint UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
                    sku varchar(255) NOT NULL,
                    name varchar(255) NOT NULL,
                    price decimal(10,2) NOT NULL,
                    old_price decimal(10,2) NULL DEFAULT NULL,
                    description varchar(255) NULL DEFAULT NULL,
                    category_id bigint UNSIGNED NOT NULL,
                    is_published tinyint(1) NOT NULL DEFAULT 1,
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
            DB::statement('DROP TABLE products');
        } catch (\Throwable $t) {
            echo $t->getMessage();
        }
    }
};
