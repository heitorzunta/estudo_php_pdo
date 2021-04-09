<?php

require_once 'autoload.php';
use Alura\Pdo\Domain\Model\Student;
use DateTimeImmutable;
use Alura\Pdo\Infrastructure\Persistence\connectionFactory;

// Conexão com o Banco
$pdo = connectionFactory::connection();


$query = 'SELECT * FROM students';
$statement = $pdo->query($query);
$studenListData = $statement->fetchAll(PDO::FETCH_ASSOC);
$studenList = [];


// Lazy loading
// $studenList = [];
// while ($studentData = $statement->fetch(PDO::FETCH_ASSOC)){
//     $studenList [] = new Student(
//         $studentData['id'],
//         $studentData['name'],
//         new DateTimeImmutable($studentData['birthDate'])
//     );
// }

foreach ($studenListData as $studentData){
    $studenList [] = new Student(
        $studentData['id'],
        $studentData['name'],
        new DateTimeImmutable($studentData['birthDate'])
    );
}

var_dump($studenList);

?>