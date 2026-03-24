<?php

namespace App\Entity;

use App\Repository\VoucherRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: VoucherRepository::class)]
#[ORM\Table(name: 'voucher')]
class Voucher
{

    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $uuid = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name: 'template_uuid', referencedColumnName: 'uuid', nullable: false)]
    private ?VoucherTemplate $template = null;

    #[ORM\Column(length: 255)]
    private ?string $fullName = null;

    #[ORM\Column(length: 255)]
    private ?string $orcid = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column]
    private ?\DateTime $createdAt = null;

    #[ORM\Column]
    private ?bool $redeemed = false;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $terms = null;

    #[ORM\Column]
    private ?\DateTime $activeFrom = null;

    #[ORM\Column]
    private ?\DateTime $activeTo = null;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->redeemed = false;
    }

    public function getUuid(): ?Uuid
    {
        return $this->uuid;
    }

    public function getTemplate(): ?VoucherTemplate
    {
        return $this->template;
    }

    public function setTemplate(?VoucherTemplate $template): self
    {
        $this->template = $template;
        return $this;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): self
    {
        $this->fullName = $fullName;
        return $this;
    }

    public function getOrcid(): ?string
    {
        return $this->orcid;
    }

    public function setOrcid(string $orcid): self
    {
        $this->orcid = $orcid;
        return $this;
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

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function isRedeemed(): ?bool
    {
        return $this->redeemed;
    }

    public function getRedeemed(): ?bool
    {
        return $this->redeemed;
    }

    public function setRedeemed(bool $redeemed): self
    {
        $this->redeemed = $redeemed;
        return $this;
    }

    public function getActiveFrom(): ?\DateTime
    {
        return $this->activeFrom;
    }

    public function setActiveFrom(\DateTime $activeFrom): self
    {
        $this->activeFrom = $activeFrom;
        return $this;
    }

    public function getActiveTo(): ?\DateTime
    {
        return $this->activeTo;
    }

    public function setActiveTo(\DateTime $activeTo): self
    {
        $this->activeTo = $activeTo;
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
}
