<?php
namespace Alura\Pdo\Domain\Repository;

use Alura\Pdo\Domain\Model\Student;
use DateTime;

interface StudentRepository {

    public function allStudents(): array;
    public function studentsBirthday(DateTime $birthday): array;
    public function save(Student $student): bool;
    public function remove(Student $student): bool;
}
?>