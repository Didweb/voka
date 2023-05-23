<?php

namespace App\Vokabular\Api\Domain\Model\Users;

use App\Vokabular\Api\Domain\Model\Users\ValueObjects\UserId;
use App\Vokabular\Api\Shared\Domain\ValueObjects\Email;


class User
{
    private UserId $id;
    private string $name;
    private Email $email;
    private \DateTime $createdAt;
    private \DateTime $updatedAt;
    private ?UserTrainingCollection $trianings;

    public function __construct(UserId $id,
                                string $name,
                                string $email,
                                ?\DateTime $createdAt,
                                ?\DateTime $updatedAt,
                                ?UserTrainingCollection $trainingCollection
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = Email::createValidated($email);
        $this->createdAt = ($createdAt === null)?new \DateTime():$createdAt;
        $this->updatedAt = ($updatedAt === null)?new \DateTime():$updatedAt;
        $this->trianings = ($trainingCollection == null)?null:$trainingCollection;
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): Email
    {
        return $this->email;
    }

    public function createdAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function updatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function trianings(): ?UserTrainingCollection
    {
        return $this->trianings;
    }


    public function getRoles()
    {
        $roles = $this->roles;

        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }

    public function getPassword(): ?string
    {
        return null;
    }

    public function getSalt(): ?string
    {
        return null;
    }


    public static function fromInfrastructure(object $user): self
    {

        return new User(
            UserId::create($user->id()),
            $user->name(),
            Email::create($user->email),
            $user->createdAt,
            $user->updatedAt,
            null
        );
    }
}