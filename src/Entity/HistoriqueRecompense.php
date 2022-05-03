<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\HistoriqueRecompenseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HistoriqueRecompenseRepository::class)]
#[ApiResource]
class HistoriqueRecompense
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $LibleRecomp;

    #[ORM\Column(type: 'date')]
    private $DateRecomp;

    #[ORM\Column(type: 'integer')]
    private $CoutRecomp;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibleRecomp(): ?string
    {
        return $this->LibleRecomp;
    }

    public function setLibleRecomp(string $LibleRecomp): self
    {
        $this->LibleRecomp = $LibleRecomp;

        return $this;
    }

    public function getDateRecomp(): ?\DateTimeInterface
    {
        return $this->DateRecomp;
    }

    public function setDateRecomp(\DateTimeInterface $DateRecomp): self
    {
        $this->DateRecomp = $DateRecomp;

        return $this;
    }

    public function getCoutRecomp(): ?int
    {
        return $this->CoutRecomp;
    }

    public function setCoutRecomp(int $CoutRecomp): self
    {
        $this->CoutRecomp = $CoutRecomp;

        return $this;
    }
}
