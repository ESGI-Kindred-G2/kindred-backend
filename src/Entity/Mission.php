<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MissionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MissionRepository::class)]
#[ApiResource]
class Mission
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Name;

    #[ORM\Column(type: 'integer')]
    private $Reward;

    #[ORM\Column(type: 'boolean')]
    private $Converted;

    #[ORM\Column(type: 'datetime_immutable')]
    private $CreatedAt;

    #[ORM\Column(type: 'date_immutable')]
    private $Date;

    #[ORM\Column(type: 'integer')]
    private $BonusReward;

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

    public function getReward(): ?int
    {
        return $this->Reward;
    }

    public function setReward(int $Reward): self
    {
        $this->Reward = $Reward;

        return $this;
    }

    public function getConverted(): ?bool
    {
        return $this->Converted;
    }

    public function setConverted(bool $Converted): self
    {
        $this->Converted = $Converted;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->CreatedAt;
    }

    public function setCreatedAt(\DateTimeImmutable $CreatedAt): self
    {
        $this->CreatedAt = $CreatedAt;

        return $this;
    }

    public function getDate(): ?\DateTimeImmutable
    {
        return $this->Date;
    }

    public function setDate(\DateTimeImmutable $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getBonusReward(): ?int
    {
        return $this->BonusReward;
    }

    public function setBonusReward(int $BonusReward): self
    {
        $this->BonusReward = $BonusReward;

        return $this;
    }
}
