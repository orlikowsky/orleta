<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="bigint", nullable=true)
     */
    private $facebookId;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MatchType", mappedBy="user")
     */
    private $matchTypes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserTable", mappedBy="user")
     */
    private $userTables;

    /**
     * @var string $newPassword;
     */
    private $newPassword;

    public function __toString():string
    {
        return '';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getFacebookId(): ?int
    {
        return $this->facebookId;
    }

    public function setFacebookId(?int $facebookId): self
    {
        $this->facebookId = $facebookId;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword($password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection|MatchType[]
     */
    public function getMatchTypes(): Collection
    {
        return $this->matchTypes;
    }

    /**
     * @return Collection|UserTable[]
     */
    public function getUserTables(): Collection
    {
        return $this->userTables;
    }

    /**
     * @param string $newPassword
     * @return User
     */
    public function setNewPassword($newPassword): User
    {
        $this->setPassword($newPassword);
        return $this;
    }

    /**
     * @return string
     */
    public function getNewPassword()
    {
        return $this->getPassword();
    }

     /**
     * @return string
     */
    public function getRepeatedPlainPassword()
    {
        return $this->getPassword();
    }


}
