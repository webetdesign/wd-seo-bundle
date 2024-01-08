<?php
declare(strict_types=1);

namespace WebEtDesign\SeoBundle\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use WebEtDesign\MediaBundle\Entity\Media;

/**
 * Trait SmoOpenGraphTrait
 */
trait SmoOpenGraphTrait
{
    #[Gedmo\Versioned]
    #[ORM\Column(type: Types::STRING, nullable: true)]
    protected ?string $ogTitle = null;

    #[Gedmo\Versioned]
    #[ORM\Column(type: Types::STRING, nullable: true)]
    protected ?string $ogType = null;

    #[Gedmo\Versioned]
    #[ORM\ManyToOne(targetEntity: Media::class, cascade: ['persist'])]
    protected ?Media $ogImage = null;

    #[Gedmo\Versioned]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    protected ?string $ogDescription = null;

    #[Gedmo\Versioned]
    #[ORM\Column(type: Types::STRING, nullable: true)]
    protected ?string $ogSiteName = null;

    /**
     * @return string|null
     */
    public function getOgTitle(): ?string
    {
        return $this->ogTitle;
    }

    /**
     * @param string|null $ogTitle
     * @return SmoOpenGraphTrait
     */
    public function setOgTitle(?string $ogTitle): self
    {
        $this->ogTitle = $ogTitle;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getOgType(): ?string
    {
        return $this->ogType;
    }

    /**
     * @param string|null $ogType
     * @return SmoOpenGraphTrait
     */
    public function setOgType(?string $ogType): self
    {
        $this->ogType = $ogType;
        return $this;
    }

    /**
     * @return Media|null
     */
    public function getOgImage(): ?Media
    {
        return $this->ogImage;
    }

    /**
     * @param Media|null $ogImage
     * @return SmoOpenGraphTrait
     */
    public function setOgImage(?Media $ogImage): self
    {
        $this->ogImage = $ogImage;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getOgDescription(): ?string
    {
        return $this->ogDescription;
    }

    /**
     * @param string|null $ogDescription
     * @return SmoOpenGraphTrait
     */
    public function setOgDescription(?string $ogDescription): self
    {
        $this->ogDescription = $ogDescription;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getOgSiteName(): ?string
    {
        return $this->ogSiteName;
    }

    /**
     * @param string|null $ogSiteName
     * @return SmoOpenGraphTrait
     */
    public function setOgSiteName(?string $ogSiteName): self
    {
        $this->ogSiteName = $ogSiteName;
        return $this;
    }

}
