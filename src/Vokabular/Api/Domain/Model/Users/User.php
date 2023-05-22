<?php

namespace App\Vokabular\Api\Domain\Model\Users;

use App\Vokabular\Api\Domain\Model\Users\ValueObjects\UserId;
use Symfony\Component\Security\Core\User\UserInterface;


class User implements UserInterface
{
    private UserId $id;
    private string $name;
    private string $email;
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
        $this->email = $email;
        $this->createdAt = ($createdAt === null)?new \DateTime():$createdAt;
        $this->updatedAt = ($updatedAt === null)?new \DateTime():$updatedAt;
        $this->trianings = ($trainingCollection === null)?UserTrainingCollection::init():$trainingCollection;
    }

    public function id(): UserId
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

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUsername()
    {
        // TODO: Implement getUsername() method.
    }

    public function __call(string $name, array $arguments)
    {
        // TODO: Implement @method string getUserIdentifier()
    }
}