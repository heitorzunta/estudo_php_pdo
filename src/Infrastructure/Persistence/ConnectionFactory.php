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
            $connection = new PDO($dsn);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            //caso queira mudar a saida padrão do fetch de both para assoc
            // por exemplo basta adicionar a linha abaixo:
            $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $connection;

        } catch (PDOException $e){
            echo ("ERRO:" . $e->getMessage());
        }

    }
}
?>