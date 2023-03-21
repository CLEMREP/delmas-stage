<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            DROP PROCEDURE IF EXISTS `count_hire_companies`;
            CREATE PROCEDURE count_hire_companies(IN seriesId TEXT, IN statusCode INT)
            BEGIN
                DECLARE i INT DEFAULT 1;
                DECLARE id_str VARCHAR(255);

                CREATE TABLE IF NOT EXISTS `temps` (
                    `id` CHAR(3) PRIMARY KEY
                );
                
                SET seriesId = REPLACE(seriesId, '''', '');

                WHILE i <= LENGTH(seriesId)-1 DO
                    SET id_str = SUBSTRING_INDEX(SUBSTRING_INDEX(seriesId, ',', i), ',', -1);
                    SET i = i + 1;
                    INSERT INTO temps (id) VALUES (id_str);
                END WHILE;

                select count(*) from `companies`
                where exists (
                    select * from `users`
                    where `companies`.`user_id` = `users`.`id`
                    and exists (
                        select * from `promotions`
                        where `users`.`promotion_id` = `promotions`.`id`
                        and `serie_id` in (SELECT id FROM `temps`))) and exists (
                            select * from `procedures`
                            where `companies`.`id` = `procedures`.`company_id`
                            and `status_id` = statusCode);
                            
              DROP TABLE `temps`;         
            END;"
        );
    }
};
