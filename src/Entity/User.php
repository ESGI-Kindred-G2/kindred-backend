<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[ORM\Entity(repositoryClass: UserRepository::class)]
/**
 *
 * @ApiResource(
 *     normalizationContext={"groups"={"user:read"}},
 *     denormalizationContext={"groups"={"user:write"}}
 * )
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
     /**
     * @Groups("user:read")
     */
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
     /**
     * @Groups({"user:read", "user:write"})
     */
    private $email;

    #[ORM\Column(type: 'json')]
     /**
     * @Groups("user:read")
     */
    private $roles = [];

    #[ORM\Column(type: 'string')]
    /**
     * @var string The hashed password
     */
    private $password;

    #[ORM\Column(type: 'string', length: 255)]
    /**
     * @Groups({"user:read", "user:write"})
     */
    private $name;

    #[ORM\Column(type: 'integer', nullable: true)]
     /**
     * @Groups({"user:read", "user:write"})
     */
    private $bonusPoints;

    /**
     * @Groups("user:write")
     * @SerializedName("password")
     */
    private $plainPassword;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Mission::class)]
    private $missions;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Bonus::class)]
    /**
     * @Groups("user:read")
     */
    private $bonus;

    #[ORM\ManyToMany(targetEntity: Contracts::class, inversedBy: 'users')]
    private $contracts;

    public function __construct()
    {
        $this->missions = new ArrayCollection();
        $this->bonus = new ArrayCollection();
        $this->contracts = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
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

    public function setRoles(array $roles): self
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

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function setPlainPassword(string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPlainPassword(): string
    {
        return $this->plainPassword;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
         $this->plainPassword = null;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBonusPoints(): ?int
    {
        return $this->bonusPoints;
    }

    public function setBonusPoints(?int $bonusPoints): self
    {
        $this->bonusPoints = $bonusPoints;

        return $this;
    }

    /**
     * @return Collection<int, Mission>
     */
    public function getMissions(): Collection
    {
        return $this->missions;
    }

    public function addMission(Mission $mission): self
    {
        if (!$this->missions->contains($mission)) {
            $this->missions[] = $mission;
            $mission->setUser($this);
        }

        return $this;
    }

    public function removeMission(Mission $mission): self
    {
        if ($this->missions->removeElement($mission)) {
            // set the owning side to null (unless already changed)
            if ($mission->getUser() === $this) {
                $mission->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Bonus>
     */
    public function getBonus(): Collection
    {
        return $this->bonus;
    }

    public function addBonu(Bonus $bonu): self
    {
        if (!$this->bonus->contains($bonu)) {
            $this->bonus[] = $bonu;
            $bonu->setUser($this);
        }

        return $this;
    }

    public function removeBonu(Bonus $bonu): self
    {
        if ($this->bonus->removeElement($bonu)) {
            // set the owning side to null (unless already changed)
            if ($bonu->getUser() === $this) {
                $bonu->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Contracts>
     */
    public function getContracts(): Collection
    {
        return $this->contracts;
    }

    public function addContract(Contracts $contract): self
    {
        if (!$this->contracts->contains($contract)) {
            $this->contracts[] = $contract;
        }

        return $this;
    }

    public function removeContract(Contracts $contract): self
    {
        $this->contracts->removeElement($contract);

        return $this;
    }

}
