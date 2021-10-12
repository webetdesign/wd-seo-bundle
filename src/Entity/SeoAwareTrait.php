<?php

namespace WebEtDesign\SeoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

trait SeoAwareTrait
{
    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $seoTitle = null;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $seoDescription = null;

    public function getSeoTitle(): ?string
    {
        if ($this->seoTitle === null) {
            return $this->__toString();
        }

        return $this->seoTitle;
    }

    public function setSeoTitle($seoTitle): self
    {
        $this->seoTitle = $seoTitle;

        return $this;
    }

    public function getSeoDescription(): ?string
    {
        return $this->seoDescription;
    }

    public function setSeoDescription($seoDescription): self
    {
        $this->seoDescription = $seoDescription;

        return $this;
    }
}
