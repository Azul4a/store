<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        try {
            DB::statement('
                CREATE TABLE user_warehouses (
                    id bigint UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
                    user_id bigint UNSIGNED NOT NULL,
                    warehouse_id bigint UNSIGNED NOT NULL,
                    created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    updated_at timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
                    UNIQUE INDEX uid_wid_user_warehouses (user_id, warehouse_id)
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
            DB::statement('DROP TABLE user_warehouses');
        } catch (\Throwable $t) {
            echo $t->getMessage();
        }
    }
};
