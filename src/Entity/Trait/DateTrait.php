<?php

namespace App\Entity\Trait;

use Doctrine\ORM\Mapping as ORM;

#[ORM\HasLifecycleCallbacks]
trait DateTrait
{
    #[ORM\Column]
    private ?int $creationDate = null;

    #[ORM\Column]
    private ?int $lastUpdateDate = null;

    public function getCreationDate(): ?int
    {
        return $this->creationDate;
    }

    #[ORM\PrePersist]
    public function setCreationDate(): self
    {
        $this->creationDate = time();
        return $this;
    }

    public function getLastUpdateDate(): ?int
    {
        return $this->lastUpdateDate;
    }

    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function setLastUpdateDate(): self
    {
        $this->lastUpdateDate = time();
        return $this;
    }
}
