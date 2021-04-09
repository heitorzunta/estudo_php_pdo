<?php

namespace Alura\Pdo\Domain\Model;

use DomainException;

class Student
{
    private ?int $id;
    private string $name;
    private \DateTimeInterface $birthDate;

    public function __construct(?int $id, string $name, \DateTimeInterface $birthDate)
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

    public function birthDate(): \DateTimeInterface
    {
        return $this->birthDate;
    }

    public function age(): int
    {
        return $this->birthDate
            ->diff(new \DateTimeImmutable())
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
