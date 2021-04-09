<?php

namespace Alura\Pdo\Infrastructure\Persistence;

use PDO;
use PDOException;

class ConnectionFactory {

    public static function connection(): PDO
    {
        try{
            $path = __DIR__ . '../../../../vendor/banco.sqlite';
            /*
            * dsn é uma string de conexão que o PDO utiliza para conectar a um determinado banco, neste caso estamos usando o sqlite.
            * Caso queira modificar o banco basta trocar o dsn.
            * estrutura: driver:informacoes_especificas_do_driver
            */
            $dsn = 'sqlite:' . $path;
            return new PDO($dsn);

        } catch (PDOException $e){
            echo ("ERRO:" . $e->getMessage());
        }

    }
}
?>