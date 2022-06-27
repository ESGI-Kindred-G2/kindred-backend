<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\BonusRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BonusRepository::class)]
#[ApiResource]
class Bonus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    /**
     * @Groups({"bonus:read", "user:read"})
     */
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    /**
     * @Groups({"bonus:read", "user:read"})
     */
    private $Name;

    #[ORM\Column(type: 'integer')]
    /**
     * @Groups({"bonus:read", "user:read"})
     */
    private $Price;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'bonus')]
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->Price;
    }

    public function setPrice(int $Price): self
    {
        $this->Price = $Price;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
