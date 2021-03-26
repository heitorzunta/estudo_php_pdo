<?php

use Alura\Pdo\Domain\Model\Student;

require_once "autoload.php";

$path = __DIR__ . '/banco.sqlite';
$dsn = 'sqlite:' . $path;
$pdo = new PDO($dsn);

echo 'Conectado com sucesso'.PHP_EOL;


$student = new Student(
    $int = null,
    $name = 'Heitor Batistela Zunta',
    $bithDate = new DateTimeImmutable('26-11-1983')
);

$requestInsert = "INSERT INTO students (name, birthDate) VALUES ('{$student->name()}', '{$student->birthDate()->format('Y-m-d')}')";

var_dump($pdo->exec($requestInsert));

?>