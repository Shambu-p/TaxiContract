<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 3/1/2021
 * Time: 11:46 AM
 */
namespace Application\conf;

class AuthConfiguration {

    public static array $conf = [
        "user_auth" => [
            "table" => "Application\\Models\\UsersModel",
            "with" => ["username", "password"],
            "order" => "keep",//once
            "save" => ["id", "username", "email", "role"]
        ],
        "admin_auth" => [
            "table" => "Absoft\\App\\Administration\\AdminModel",
            "with" => ["username", "password"],
            "order" => "keep",
            "save" => ["id", "username", "role", "fullname"]
        ]
    ];

    /**
     * @var int
     * this variable should only be integer value which will set
     * after how many hours the token expired.
     */
    public static int $TOKEN_EXPIRATION = 24;

}
