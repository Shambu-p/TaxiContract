<?php
namespace Application\Builders;

use Absoft\Line\Core\Modeling\DbBuilders\Builder;
use Absoft\Line\Core\Modeling\DbBuilders\Schema;


class Schedule extends Builder{

    function construct(Schema $table, $table_name = "Schedule"){

        $this->TABLE_NAME = $table_name;

        $this->ATTRIBUTES = [
            //@att_start
            $table->autoincrement("id"),
            $table->string("pick_up")->length(10)->nullable(false),
            $table->string("drop_off")->length(10)->nullable(false),
            // $table->string("day_week")->nullable(false)->length(4),
            $table->int("start_date")->nullable(false)->length(20)->sign(false),
            $table->int("end_date")->nullable(false)->length(20)->sign(false),
            $table->int("driver_id")->nullable(false)->sign(false),
            $table->string("client")->nullable(false)->length(30)->sign(false),
            $table->string("route")->nullable(false)->length(100)->sign(false),
            $table->string("days")->nullable(false)->length(100)->sign(false)
            //@att_end
        ];
        
        $this->HIDDEN_ATTRIBUTES = [
            //@hide_start
            //@hide_end
        ];

    }

}