<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface,\Serializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
	/**
	 * Returns the roles granted to the user.
	 *
	 * public function getRoles()
	 * {
	 * return ['ROLE_USER'];
	 * }
	 *
	 * Alternatively, the roles might be stored in a ``roles`` property,
	 * and populated in any number of different ways when the user object
	 * is created.
	 *
	 * @return array The user roles
	 */
	function getRoles() {
        return ['ROLE_ADMIN'];
	}
	
	/**
	 * Returns the salt that was originally used to encode the password.
	 *
	 * This can return null if the password was not encoded using a salt.
	 *
	 * @return null|string The salt
	 */
	function getSalt() {
        return null;
	}
	
	/**
	 * Removes sensitive data from the user.
	 *
	 * This is important if, at any given point, sensitive information like
	 * the plain-text password is stored on this object.
	 *
	 * @return mixed
	 */
	function eraseCredentials() {
	}
	/**
	 * Représentation linéaire de l'objet
	 * Retourne la représentation en chaîne de caractères de l'objet.
	 *
	 * @return null|string Retourne la représentation de l'objet en chaîne de caractères, ou bien `null` .
	 */
	function serialize() {
        return serialize([
            $this->id,
            $this->username,
            $this->password
        ]);
	}
	
	/**
	 * Construit un objet
	 * Appelé lors de la délinéarisation de l'objet.
	 *
	 * @param string $data La représentation en chaîne de l'objet.
	 */
	function unserialize($serialize) {
        list(
            $this->id,
            $this->username,
            $this->password
        ) = unserialize($serialize, ['allowed_classes' => false]);
	}
}
