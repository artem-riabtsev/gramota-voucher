<?php

namespace App\Entity;

use App\Repository\VoucherRepository;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VoucherRepository::class)]
class Voucher
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $uuid = null;

    #[ORM\Column(length: 255)]
    private ?string $journal = null;

    #[ORM\Column(length: 255)]
    private ?string $fullName = null;

    #[ORM\Column(length: 255)]
    private ?string $orcid = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column]
    private ?\DateTime $validFrom = null;

    #[ORM\Column]
    private ?\DateTime $validTo = null;

    #[ORM\Column]
    private ?\DateTime $createdAt = null;

    public function getUuid(): ?Uuid
    {
        return $this->uuid;
    }

    public function getJournal(): ?string
    {
        return $this->journal;
    }

    public function setJournal(string $journal): static
    {
        $this->journal = $journal;

        return $this;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): static
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getOrcid(): ?string
    {
        return $this->orcid;
    }

    public function setOrcid(string $orcid): static
    {
        $this->orcid = $orcid;

        return $this;
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

    public function getValidFrom(): ?\DateTime
    {
        return $this->validFrom;
    }

    public function setValidFrom(\DateTime $validFrom): static
    {
        $this->validFrom = $validFrom;

        return $this;
    }

    public function getValidTo(): ?\DateTime
    {
        return $this->validTo;
    }

    public function setValidTo(\DateTime $validTo): static
    {
        $this->validTo = $validTo;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
