<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MissionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'missions')]
    private $user;

    #[ORM\ManyToOne(targetEntity: Categories::class, inversedBy: 'missions')]
    private $categories;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $evaluated;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $completed;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $daysOfWeek;

    #[ORM\OneToMany(mappedBy: 'missionId', targetEntity: MissionsHistory::class)]
    private $missionsHistories;

    public function __construct()
    {
        $this->missionsHistories = new ArrayCollection();
    }

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCategories(): ?Categories
    {
        return $this->categories;
    }

    public function setCategories(?Categories $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

    public function getEvaluated(): ?int
    {
        return $this->evaluated;
    }

    public function setEvaluated(?int $evaluated): self
    {
        $this->evaluated = $evaluated;

        return $this;
    }

    public function getCompleted(): ?int
    {
        return $this->completed;
    }

    public function setCompleted(?int $completed): self
    {
        $this->completed = $completed;

        return $this;
    }

    public function getDaysOfWeek(): ?string
    {
        return $this->daysOfWeek;
    }

    public function setDaysOfWeek(?string $daysOfWeek): self
    {
        $this->daysOfWeek = $daysOfWeek;

        return $this;
    }

    /**
     * @return Collection<int, MissionsHistory>
     */
    public function getMissionsHistories(): Collection
    {
        return $this->missionsHistories;
    }

    public function addMissionsHistory(MissionsHistory $missionsHistory): self
    {
        if (!$this->missionsHistories->contains($missionsHistory)) {
            $this->missionsHistories[] = $missionsHistory;
            $missionsHistory->setMissionId($this);
        }

        return $this;
    }

    public function removeMissionsHistory(MissionsHistory $missionsHistory): self
    {
        if ($this->missionsHistories->removeElement($missionsHistory)) {
            // set the owning side to null (unless already changed)
            if ($missionsHistory->getMissionId() === $this) {
                $missionsHistory->setMissionId(null);
            }
        }

        return $this;
    }
}
