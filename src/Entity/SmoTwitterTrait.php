<?php

namespace WebEtDesign\SeoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use WebEtDesign\MediaBundle\Entity\Media;

trait SmoTwitterTrait
{
    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $twitterCard = null;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $twitterSite = null;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $twitterTitle = null;

    /**
     * @var string|null
     *
     * @ORM\Column( type="text", nullable=true)
     */
    private ?string $twitterDescription = null;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $twitterCreator = null;

    /**
     * @var Media|null
     *
     * @ORM\ManyToOne(targetEntity="WebEtDesign\MediaBundle\Entity\Media", cascade={"persist"})
     */
    private ?Media $twitterImage = null;

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
