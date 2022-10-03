<?php
namespace Application\Builders;

use Absoft\Line\Core\Modeling\DbBuilders\Builder;
use Absoft\Line\Core\Modeling\DbBuilders\Schema;


class Days extends Builder{

    function construct(Schema $table, $table_name = "Days"){

        $this->TABLE_NAME = $table_name;

        $this->ATTRIBUTES = [
            //@att_start
            $table->int("schedule_id")->nullable(false)->length(20)->sign(false),
            $table->int("driver_id")->nullable(false)->sign(false),
            $table->string("day")->nullable(false)->length(20),
            //@att_end
        ];
        
        $this->HIDDEN_ATTRIBUTES = [
            //@hide_start
            //@hide_end
        ];

    }

}