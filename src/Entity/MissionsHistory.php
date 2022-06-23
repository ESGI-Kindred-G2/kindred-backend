<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MissionsHistoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MissionsHistoryRepository::class)]
#[ApiResource]
class MissionsHistory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime')]
    private $evaluatedDate;

    #[ORM\Column(type: 'datetime')]
    private $completedDate;

    #[ORM\ManyToOne(targetEntity: Mission::class, inversedBy: 'missionsHistories')]
    private $missionId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEvaluatedDate(): ?\DateTimeInterface
    {
        return $this->evaluatedDate;
    }

    public function setEvaluatedDate(\DateTimeInterface $evaluatedDate): self
    {
        $this->evaluatedDate = $evaluatedDate;

        return $this;
    }

    public function getCompletedDate(): ?\DateTimeInterface
    {
        return $this->completedDate;
    }

    public function setCompletedDate(\DateTimeInterface $completedDate): self
    {
        $this->completedDate = $completedDate;

        return $this;
    }

    public function getMissionId(): ?Mission
    {
        return $this->missionId;
    }

    public function setMissionId(?Mission $missionId): self
    {
        $this->missionId = $missionId;

        return $this;
    }
}
