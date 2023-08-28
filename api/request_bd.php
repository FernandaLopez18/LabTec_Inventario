<?php

// ? Ambiente en que te encuentras:
// Develop: Desarrollo
// Testing: Testeo, QA, etapa de pruebas
// Desploy: Producción (Ya funcionando al 100%) 

define("ENVIRONMENT", "develop");

if (ENVIRONMENT == "develop") {
    // ? Muestre errores
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
            "USER__DB" => "root",
            "PASSWORD__DB" => "",
            "NAME__DB" => "labtec",
            "CHARSET__DB" => "utf8"
        ]
    ],
    "testing" => [
        "BD" => [
            "HOST__DB" => "192.168.0.1",
            "USER__DB" => "root",
            "PASSWORD__DB" => "",
            "NAME__DB" => "labtec",
            "CHARSET__DB" => "utf8"
        ]
    ],
    "deploy" => [
        "BD" => [
            "HOST__DB" => "www.google.com",
            "USER__DB" => "root",
            "PASSWORD__DB" => "",
            "NAME__DB" => "labtec",
            "CHARSET__DB" => "utf8"
        ]
    ],
];


define("DATABASE_CONFIG", $config[ENVIRONMENT]["BD"]);

class Database
{
    public static function StartUp()
    {
        $pdo = new PDO('mysql:host=' . DATABASE_CONFIG["HOST__DB"] . ';dbname=' . DATABASE_CONFIG["NAME__DB"] . ';charset=' . DATABASE_CONFIG["CHARSET__DB"], DATABASE_CONFIG["USER__DB"], DATABASE_CONFIG["PASSWORD__DB"]);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
}

function ListPedido()
{
    $pdo = Database::StartUp();
    $sql = "SELECT * FROM pedido"; 
    $result = $pdo->prepare($sql);
    $result->execute();
    $resultado = $result->fetchAll(PDO::FETCH_ASSOC);

    return $resultado;
}

function ListCompras()
{
    $pdo = Database::StartUp();
    $sql = "SELECT * FROM compras ";
    $result = $pdo->prepare($sql);
    $result->execute();
    $resultado = $result->fetchAll(PDO::FETCH_ASSOC);

    return $resultado;
}
function ListProductos()
{
    $pdo = Database::StartUp();
    $sql = "SELECT * FROM producto ";
    $result = $pdo->prepare($sql);
    $result->execute();
    $resultado = $result->fetchAll(PDO::FETCH_ASSOC);

    return $resultado;
}