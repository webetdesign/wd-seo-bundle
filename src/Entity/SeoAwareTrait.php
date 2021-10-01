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
    private ?string $seo_title = null;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $seo_description = null;

    public function getSeoTitle(): ?string
    {
        if ($this->seo_title === null) {
            return $this->__toString();
        }

        return $this->seo_title;
    }

    public function setSeoTitle($seo_title): self
    {
        $this->seo_title = $seo_title;

        return $this;
    }

    public function getSeoDescription(): ?string
    {
        return $this->seo_description;
    }

    public function setSeoDescription($seo_description): self
    {
        $this->seo_description = $seo_description;

        return $this;
    }
}
