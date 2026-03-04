<?php

namespace App\Entity;

use App\Repository\VoucherTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VoucherTypeRepository::class)]
class VoucherType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $defaultDiscount = null;

    #[ORM\Column(length: 100, unique: true)]
    private ?string $slug = null;

    #[ORM\OneToMany(targetEntity: Voucher::class, mappedBy: 'voucherType')]
    private Collection $vouchers;

    public function __construct()
    {
        $this->vouchers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    public function getDefaultDiscount(): ?int
    {
        return $this->defaultDiscount;
    }

    public function setDefaultDiscount(int $defaultDiscount): static
    {
        $this->defaultDiscount = $defaultDiscount;
        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * @return Collection<int, Voucher>
     */
    public function getVouchers(): Collection
    {
        return $this->vouchers;
    }

    public function addVoucher(Voucher $voucher): static
    {
        if (!$this->vouchers->contains($voucher)) {
            $this->vouchers->add($voucher);
            $voucher->setVoucherType($this);
        }
        return $this;
    }

    public function removeVoucher(Voucher $voucher): static
    {
        if ($this->vouchers->removeElement($voucher)) {
            if ($voucher->getVoucherType() === $this) {
                $voucher->setVoucherType(null);
            }
        }
        return $this;
    }

    public function __toString(): string
    {
        return $this->name ?? 'Новый тип';
    }
}
