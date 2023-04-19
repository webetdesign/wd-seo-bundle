<?php

namespace WebEtDesign\SeoBundle\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use WebEtDesign\MediaBundle\Entity\Media;

/**
 * Trait SmoOpenGraphTrait
 * @package WebEtDesign\CmsBundle\Utils
 */
trait SmoOpenGraphTrait
{
    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $ogTitle = null;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $ogType = null;

    /**
     * @var Media|null
     *
     * @ORM\ManyToOne(targetEntity="WebEtDesign\MediaBundle\Entity\Media", cascade={"persist"})
     */
    #[ORM\ManyToOne(targetEntity: Media::class, cascade: ['persist'])]
    private ?Media $ogImage = null;

    /**
     * @var string|null
     *
     * @ORM\Column(type="text", nullable=true)
     */
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $ogDescription = null;

    /**
     * @var string|null
     *
     * @ORM\Column( type="string", nullable=true)
     */
    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $ogSiteName = null;

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
