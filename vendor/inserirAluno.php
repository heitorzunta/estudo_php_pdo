<?php

use Alura\Pdo\Domain\Model\Student;

require_once "autoload.php";

$path = __DIR__ . '/banco.sqlite';
$dsn = 'sqlite:' . $path;
$pdo = new PDO($dsn);

echo 'Conectado com sucesso'.PHP_EOL;


$student = new Student(
    $int = null,
    $name = 'Geciani Mirian Silva',
    $bithDate = new DateTimeImmutable('22-10-1983')
);

$sqlInsert = 'INSERT INTO students
     (name, birthDate)
      VALUES
      (:name, :birthDate);';    
$statement = $pdo->prepare($sqlInsert);
$statement->bindValue(':name', $student->name());
$statement->bindValue(':birthDate', $student->birthDate()->format('Y-m-d'));

if($statement->execute()){
    echo 'Aluno incluso!';
}
else{
    echo 'Erro ao incluir aluno';
}
?>