<?php
namespace Application\Builders;

use Absoft\Line\Core\Modeling\DbBuilders\Builder;
use Absoft\Line\Core\Modeling\DbBuilders\Schema;


class Students extends Builder{

    function construct(Schema $table, $table_name = "Students"){

        $this->TABLE_NAME = $table_name;

        $this->ATTRIBUTES = [
            //@att_start
            $table->string("client_id")->length(30)->nullable(false)->setPrimaryKey(),
            $table->string("name")->length(100)->nullable(false)
            //@att_end
        ];
        
        $this->HIDDEN_ATTRIBUTES = [
            //@hide_start
            //@hide_end
        ];

    }

}

        