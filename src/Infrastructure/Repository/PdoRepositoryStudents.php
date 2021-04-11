<?php

namespace Alura\Pdo\Infrastructure\Repository;

use Alura\Pdo\Domain\Repository\StudentRepository;
use Alura\Pdo\Domain\Model\Student;
use PDO;
use DateTime;
use DateTimeImmutable;
use PDOStatement;

/**
 * O conceito de extrair toda a lógica de acesso aos dados de nosso domínio é chamado de
 * **Repository**, o qual é uma classe que nos permitirá acessarmos o local que armazena
 * nossas informações com uma interface de coleção.
 * Portanto não inseriremos um aluno no repositório, e sim o salvaremos como em uma
 * coleção; dentro de save() é tratado como banco de dados, afinal há a diferença de
 * insert() e update().
 * Não tentaremos buscar os alunos por data, e sim pegaremos aqueles que fazem aniversário
 * nesta data. A forma de nomear os métodos que lembra uma coleção é o que define um
 * repositório.
 * Se tivéssemos somente quatro métodos públicos de buscar, inserir, atualizar e remover,
 * não configuraria um repositório, e sim outro padrão chamado **DAO** ou Data Access Object
 * ou ainda Objeto de Acesso a Dados. O Repository traz uma forma de trabalhar mais
 * amigável, então preferiremos chamar os métodos da mesma maneira como chamamos uma
 * coleção.
 */

class PdoRepositoryStudents implements StudentRepository{

    private PDO $connection;


    //Injeção de dependencia
    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function allStudents(): array
    {
        $sqlListALL = "SELECT * FROM students;";
        $statement = $this->connection->query($sqlListALL);
        return $this->hydratateStudentList($statement);
    }

    public function studentsBirthday(DateTime $birthday): array
    {
        $sqlListBirthDay = "SELECT name FROM students WHERE
             birthDate LIKE :birthDate;";

        $statement = $this->connection->prepare($sqlListBirthDay);
        $statement->bindValue(":birthDate", $birthday->format('Y-m-d'));
        $statement->execute();
        return $this->hydratateStudentList($statement);    
    }

    /**
     * Este é o conceito de "hidratar", sendo um padrão que simplesmente transfere dados
     *  de uma camada para outra; ou seja, estamos trazendo da camada do banco de dados
     *  para a de nossa classe, devolvendo esta lista de alunos.
     */

    public function hydratateStudentList(PDOStatement $statement): array
    {
        $studentList = [];
        while ($studentData = $statement->fetch()){
            $studentList[] = new Student(
                $studentData['id'],
                $studentData['name'],
                new DateTimeImmutable($studentData['birthDate'])
            );    
        }
        return $studentList;
    }

    public function save(Student $student): bool
    {
        if (is_null($student->id())){
            return $this->insert($student);
        }
        return $this->update($student);
    }

    public function update(Student $student): bool
    {
        $sqlUpdate = "UPDATE students SET 
            name = :name,
            birthDate =  :birthDate'
            WHERE id LIKE :id";
        
        $statement = $this->connection->prepare($sqlUpdate);
        $statement->bindValue(":name", $student->name());
        $statement->bindValue("birthDate", $student->birthDate()->format('Y-m-d'));
        $statement->bindValue(":id", $student->id(), PDO::PARAM_INT);
        return $statement->execute();
    }

    public function insert(Student $student): bool
    {
        $sqlInsert = 'INSERT INTO students (name, birthDate) VALUES (:name, :birthDate);';   
        $statementPrepare = $this->connection->prepare($sqlInsert);
        $statementPrepare->bindValue(':name', $student->name());
        $statementPrepare->bindValue(':birthDate', $student->birthDate()->format('Y-m-d'));
        
        //Adicionar ID ao banco em caso de SQLite
        $student->defineId($this->connection->lastInsertId());
        
        return $statementPrepare->execute();
    }

    public function remove(Student $student): bool
    {
        $sqlDelete = 'DELETE FROM students WHERE id = :id;';
        $statementPrepared = $this->connection->prepare($sqlDelete);
        $statementPrepared->bindValue(':id', $student->id(), PDO::PARAM_INT);
        
        return $statementPrepared->execute();
    }

}
?>