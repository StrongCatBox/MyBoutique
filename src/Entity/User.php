<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(
    fields: ['email'],
    message: 'cet email existe deja',
    groups: ['register']
)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\Email(
        message: 'L\'email {{ value }} n\'est pas valide',
        groups: ['register']
    )]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]

    #[Assert\NotBlank(
        message: 'vous devez entrer un mdp',
        groups: ['register']
    )]
    /*#[Assert\Regex(
        pattern: '#(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,}#',
        match: true,
        message: 'le mot de passe doit faire un minimum de 8 caractere et contenir au moins une minuscule, au moins une majuscule et au moins un chiffre'
    )]*/
    private ?string $password = null;

    #[Assert\EqualTo(
        propertyPath: 'password',
        message: 'Les deux mdp ne sont pas identiques',
        groups: ['register']
    )]
    public $confirmPassword;

    private $oldPassword;


    #[Assert\NotBlank(message: "Vous devez entrer un mdp")]
    /*  #[Assert\Regex(
        pattern: '#(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,}#',
        match: true,
        message: 'le mot de passe doit faire un minimum de 8 caractere et contenir au moins une minuscule, au moins une majuscule et au moins un chiffre'
    )]*/

    private $newPassword;

    #[Assert\EqualTo(
        propertyPath: 'newPassword',
        message: 'Les deux mdp ne sont pas identiques'
    )]
    private $confirmNewPassword;



    #[ORM\Column(length: 255)]

    #[Assert\NotBlank(message: 'vous devez entrer un prenom', groups: ['register'])]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'le prenom doit avoir un maximum de {{ limit }} caracteres',
        maxMessage: 'le prenom doit avoir un maximum de {{ limit }} caracteres',
    )]



    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'vous devez entrer un nom', groups: ['register'])]
    #[Assert\Length(
        min: 2,
        max: 50,
        minMessage: 'le prenom doit avoir un maximum de {{ limit }} caracteres',
        maxMessage: 'le prenom doit avoir un maximum de {{ limit }} caracteres',
    )]
    private ?string $lastName = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
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

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getfirstName(): ?string
    {
        return $this->firstName;
    }

    public function setfirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getlastName(): ?string
    {
        return $this->lastName;
    }

    public function setlastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get the value of oldPassword
     */
    public function getOldPassword()
    {
        return $this->oldPassword;
    }

    /**
     * Set the value of oldPassword
     *
     * @return  self
     */
    public function setOldPassword($oldPassword)
    {
        $this->oldPassword = $oldPassword;

        return $this;
    }

    /**
     * Get the value of newPassword
     */
    public function getNewPassword()
    {
        return $this->newPassword;
    }

    /**
     * Set the value of newPassword
     *
     * @return  self
     */
    public function setNewPassword($newPassword)
    {
        $this->newPassword = $newPassword;

        return $this;
    }

    /**
     * Get the value of confirmNewPassword
     */
    public function getConfirmNewPassword()
    {
        return $this->confirmNewPassword;
    }

    /**
     * Set the value of confirmNewPassword
     *
     * @return  self
     */
    public function setConfirmNewPassword($confirmNewPassword)
    {
        $this->confirmNewPassword = $confirmNewPassword;

        return $this;
    }
}
