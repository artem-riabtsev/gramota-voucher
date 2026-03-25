<?php

namespace App\Entity;

use App\Repository\VoucherTemplateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: VoucherTemplateRepository::class)]
#[ORM\Table(name: 'voucher_template')]
class VoucherTemplate
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $uuid = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $terms = null;

    #[ORM\Column(type: 'date')]
    private ?\DateTime $releasedFrom = null;

    #[ORM\Column(type: 'date')]
    private ?\DateTime $releasedTo = null;

    #[ORM\Column(length: 255)]
    private ?string $availabilityStatus = null;

    #[ORM\Column]
    private ?\DateTime $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?int $activeFromDelay = null;

    #[ORM\Column(nullable: true)]
    private ?int $activeToDelay = null;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getUuid(): ?Uuid
    {
        return $this->uuid;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getTerms(): ?string
    {
        return $this->terms;
    }

    public function setTerms(string $terms): self
    {
        $this->terms = $terms;
        return $this;
    }

    public function getReleasedFrom(): ?\DateTime
    {
        return $this->releasedFrom;
    }

    public function setReleasedFrom(\DateTime $releasedFrom): self
    {
        $this->releasedFrom = $releasedFrom;
        return $this;
    }

    public function getReleasedTo(): ?\DateTime
    {
        return $this->releasedTo;
    }

    public function setReleasedTo(\DateTime $releasedTo): self
    {
        $this->releasedTo = $releasedTo;
        return $this;
    }

    public function getAvailabilityStatus(): ?string
    {
        return $this->availabilityStatus;
    }

    public function setAvailabilityStatus(string $availabilityStatus): self
    {
        $this->availabilityStatus = $availabilityStatus;
        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getActiveFromDelay(): ?int
    {
        return $this->activeFromDelay;
    }

    public function setActiveFromDelay(?int $activeFromDelay): self
    {
        $this->activeFromDelay = $activeFromDelay;
        return $this;
    }

    public function getActiveToDelay(): ?int
    {
        return $this->activeToDelay;
    }

    public function setActiveToDelay(?int $activeToDelay): self
    {
        $this->activeToDelay = $activeToDelay;
        return $this;
    }
}
