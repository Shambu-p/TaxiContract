<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 1/25/2020
 * Time: 3:36 PM
 */

namespace Absoft\Line\Core\DbConnection\Attributes\SQL;

class Date extends Attribute
{

    public $length = 0;
    public $nullable = true;
    public $type = "date";
    public $auto_increment = false;
    public $unique = false;

    function __construct($name){

        $this->name = $name;
    }


    function Reference($table_name)
    {
        $this->foreign = $table_name;
        return $this;
    }

    function getReference()
    {
        return $this->foreign;
    }

    function on($attribute_name)
    {
        $this->reference = $attribute_name;
        return $this;
    }

    function getAttribute()
    {
        return $this->reference;
    }

    function getLength()
    {
        return 0;
    }

    function length($length)
    {
        return $this;
    }

    function nullable($boolean)
    {
        $this->nullable = $boolean;
        return $this;
    }

    function getNullable() {
        return $this->nullable;
    }

    function getName() {
        return $this->name;
    }

    function sign($boolean){
        return $this;
    }

    function auto_increment($boolean){
        return $this;
    }

    function setPrimaryKey()
    {
        $this->key = "primary key";
        return $this;
    }

    function unique($value) {
        return $this;
    }

}
