<?php

namespace App\Vokabular\Api\Application\Response\Users;

use App\Vokabular\Api\Domain\Model\Users\User;
use App\Vokabular\Api\Domain\Model\Users\UserTrainingCollection;
use App\Vokabular\Api\Shared\Domain\Bus\Query\Response;
use App\Vokabular\Api\Shared\Domain\ValueObjects\Email;

class UserResponse implements Response
{
    private string $id;
    private string $name;
    private string $email;
    private ?\DateTime $createdAt;
    private ?\DateTime $updatedAt;
    private ?array $trianings;

    public function __construct(User $user)
    {

        $this->id = $user->id()->value();
        $this->name = $user->name();
        $this->email = $user->email()->__toString();
        $this->createdAt = $user->createdAt();
        $this->updatedAt = $user->updatedAt();
        $this->trianings = null; //$collection->fromArray($user->trianings());
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function createdAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function updatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function trianings(): ?UserTrainingCollection
    {
        return $this->trianings;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id(),
            'name' => $this->name(),
            'email' => $this->email(),
            'createdAt' => $this->createdAt(),
            'updatedAt' => $this->updatedAt(),
            'trianings' => $this->trianings()
        ];
    }

}