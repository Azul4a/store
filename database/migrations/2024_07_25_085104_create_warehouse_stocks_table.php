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
                CREATE TABLE warehouse_stocks (
                    id bigint UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
                    product_id bigint UNSIGNED NOT NULL,
                    warehouse_id bigint UNSIGNED NOT NULL,
                    stock INT(11) NOT NULL,
                    created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    updated_at timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
                    UNIQUE INDEX pid_wid_warehouse_stocks (product_id, warehouse_id)
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
            DB::statement('DROP TABLE warehouse_stocks');
        } catch (\Throwable $t) {
            echo $t->getMessage();
        }
    }
};
