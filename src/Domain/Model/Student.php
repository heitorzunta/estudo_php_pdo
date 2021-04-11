<?php

namespace Alura\Pdo\Domain\Model;

use DomainException;
use DateTimeImmutable;

class Student
{
    private ?int $id;
    private string $name;
    private \DateTimeImmutable $birthDate;

    public function __construct(?int $id, string $name, DateTimeImmutable $birthDate)
    {
        $this->id = $id;
        $this->name = $name;
        $this->birthDate = $birthDate;
    }

    public function id(): ?int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function birthDate(): DateTimeImmutable
    {
        return $this->birthDate;
    }

    public function age(): int
    {
        return $this->birthDate
            ->diff(new DateTimeImmutable())
            ->y;
    }

    public function defineId(int $id)
    {
        if (!is_null($this->id)){
            throw new DomainException(
                'ID já existe, você não
                 pode reatribuir ID');
        }

        $this->id = $id;
    }
}
