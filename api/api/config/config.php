<?php

// ? Ambiente en que te encuentras:
// Develop: Desarrollo
// Testing: Testeo, QA, etapa de pruebas
// Desploy: Producción (Ya funcionando al 100%) 

define("ENVIRONMENT", "testing");

if(ENVIRONMENT == "develop"){
    // ? Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');
}

// BD
// - Host
// - Usuario
// - Contraseña
// - BD
// - Charset

$config = [
    "develop" => [
        "BD" => [
            "HOST__DB" => "localhost",
            "USER__DB" => "labtecco_WPXD6",
            "PASSWORD__DB" => "MR:m!h[llM2.pN53",
            "NAME__DB" => "labtecco_WPXD6",
            "CHARSET__DB" => "utf8"
        ]
    ],
    "testing" => [
        "BD" => [
            "HOST__DB" => "localhost",
            "USER__DB" => "labtecco_WPXD6",
            "PASSWORD__DB" => ":MR:m!h[llM2.pN53",
            "NAME__DB" => "labtecco_WPXD6",
            "CHARSET__DB" => "utf8"
        ]
    ],
    "deploy" => [
        "BD" => [
            "HOST__DB" => "localhost",
            "USER__DB" => "labtecco_WPXD6",
            "PASSWORD__DB" => ":MR:m!h[llM2.pN53",
            "NAME__DB" => "labtecco_WPXD6",
            "CHARSET__DB" => "utf8"
        ]
    ],
];


define("DATABASE_CONFIG", $config[ENVIRONMENT]["BD"]);
