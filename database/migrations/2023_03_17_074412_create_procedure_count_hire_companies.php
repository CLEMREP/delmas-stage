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
                CREATE TABLE IF NOT EXISTS `temps` (
                    `json_col` JSON
                );
                
                INSERT INTO `temps` (`json_col`) VALUES (seriesId);
                
                select count(*) from `companies`
                where exists (
                    select * from `users`
                    where `companies`.`user_id` = `users`.`id`
                    and exists (
                        select * from `promotions`
                        where `users`.`promotion_id` = `promotions`.`id`
                        and `serie_id` in (SELECT ids.* FROM `temps`, JSON_TABLE(json_col, '$.ids[*]' COLUMNS (id INT PATH '$.id')) ids))) and exists (
                            select * from `procedures`
                            where `companies`.`id` = `procedures`.`company_id`
                            and `status_id` = statusCode);
                            
              DROP TABLE `temps`;         
            END;"
        );
    }
};
