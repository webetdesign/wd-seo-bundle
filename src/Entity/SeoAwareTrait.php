<?php
declare(strict_types=1);

namespace WebEtDesign\SeoBundle\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

trait SeoAwareTrait
{
    #[Gedmo\Versioned]
    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    protected ?string $seoTitle = null;

    #[Gedmo\Versioned]
    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    protected ?string $seoDescription = null;

    #[Gedmo\Versioned]
    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    protected ?string $seoKeywords = null;

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

    /**
     * @return string|null
     */
    public function getSeoKeywords(): ?string
    {
        return $this->seoKeywords;
    }

    /**
     * @param string|null $seoKeywords
     */
    public function setSeoKeywords(?string $seoKeywords): void
    {
        $this->seoKeywords = $seoKeywords;
    }


}
