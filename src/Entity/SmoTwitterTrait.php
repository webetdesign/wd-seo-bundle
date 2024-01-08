<?php
declare(strict_types=1);

namespace WebEtDesign\SeoBundle\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use WebEtDesign\MediaBundle\Entity\Media;

trait SmoTwitterTrait
{
    #[Gedmo\Versioned]
    #[ORM\Column(type: Types::STRING, nullable: true)]
    protected ?string $twitterCard = null;

    #[Gedmo\Versioned]
    #[ORM\Column(type: Types::STRING, nullable: true)]
    protected ?string $twitterSite = null;

    #[Gedmo\Versioned]
    #[ORM\Column(type: Types::STRING, nullable: true)]
    protected ?string $twitterTitle = null;

    #[Gedmo\Versioned]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    protected ?string $twitterDescription = null;

    #[Gedmo\Versioned]
    #[ORM\Column(type: Types::STRING, nullable: true)]
    protected ?string $twitterCreator = null;

    #[Gedmo\Versioned]
    #[ORM\ManyToOne(targetEntity: Media::class, cascade: ['persist'])]
    protected ?Media $twitterImage = null;

    /**
     * @return string|null
     */
    public function getTwitterCard(): ?string
    {
        return $this->twitterCard;
    }

    /**
     * @param string|null $twitterCard
     * @return self
     */
    public function setTwitterCard(?string $twitterCard): self
    {
        $this->twitterCard = $twitterCard;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTwitterSite(): ?string
    {
        return $this->twitterSite;
    }

    /**
     * @param string|null $twitterSite
     * @return self
     */
    public function setTwitterSite(?string $twitterSite): self
    {
        $this->twitterSite = $twitterSite;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTwitterTitle(): ?string
    {
        return $this->twitterTitle;
    }

    /**
     * @param string|null $twitterTitle
     * @return self
     */
    public function setTwitterTitle(?string $twitterTitle): self
    {
        $this->twitterTitle = $twitterTitle;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTwitterDescription(): ?string
    {
        return $this->twitterDescription;
    }

    /**
     * @param string|null $twitterDescription
     * @return self
     */
    public function setTwitterDescription(?string $twitterDescription): self
    {
        $this->twitterDescription = $twitterDescription;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTwitterCreator(): ?string
    {
        return $this->twitterCreator;
    }

    /**
     * @param string|null $twitterCreator
     * @return self
     */
    public function setTwitterCreator(?string $twitterCreator): self
    {
        $this->twitterCreator = $twitterCreator;
        return $this;
    }

    /**
     * @return Media|null
     */
    public function getTwitterImage(): ?Media
    {
        return $this->twitterImage;
    }

    /**
     * @param Media|null $twitterImage
     * @return self
     */
    public function setTwitterImage(?Media $twitterImage): self
    {
        $this->twitterImage = $twitterImage;
        return $this;
    }
}
