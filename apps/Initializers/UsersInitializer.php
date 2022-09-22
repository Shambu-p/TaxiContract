<?php
namespace Application\Initializers;

use Absoft\Line\Core\Modeling\Initializer;

class UsersInitializer extends Initializer{

    /*
    public $VALUES = [
        [
            "id" => "the_id",
            "name" => "the_name",
        ],
        [
            "id" => "the_id",
            "name" => "the_name"
        ]
    ];

    */
    
    public $BUILDER = "Users";

    /*************************************************************************
        In this property you are expected to put all the values you want
        to insert into database. the you can initialize the operation from
        line cli.
    *************************************************************************/

    public $VALUES = [
        [
            "username" => "@admin",
            "email" => "abnetkebede075@gmail.com",
            "password" => "password",
            "role" => "admin"
        ]
    ];
    
}
?>