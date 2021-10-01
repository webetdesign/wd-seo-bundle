<?php


namespace WebEtDesign\SeoBundle\Service;

use Presta\SitemapBundle\DependencyInjection\Configuration;
use Presta\SitemapBundle\Sitemap\Urlset;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Filesystem\Filesystem;
use Presta\SitemapBundle\Service\Dumper;

class SitemapDumper extends Dumper
{
    private ParameterBagInterface $parameterBag;

    public function __construct(
        EventDispatcherInterface $dispatcher,
        Filesystem $filesystem,
        string $sitemapFilePrefix = Configuration::DEFAULT_FILENAME,
        ParameterBagInterface $parameterBag,
        int $itemsBySet = null
    ) {
        parent::__construct($dispatcher, $filesystem, $sitemapFilePrefix, $itemsBySet);
        $this->parameterBag = $parameterBag;
    }


    protected function newUrlset(
        string $name,
        \DateTimeInterface $lastmod = null,
        bool $gzExtension = false
    ): Urlset {
        $config = $this->parameterBag->get('wd_seo.section_config');
        $default = $this->baseUrl;

        if (isset($config[$name])) {
            $expr = '/(http?s):\/\/((?:(?:[a-zA-Z0-9]|[a-zA-Z0-9][a-zA-Z0-9\-]*[a-zA-Z0-9])\.)*(?:[A-Za-z0-9]|[A-Za-z0-9][A-Za-z0-9\-]*[A-Za-z0-9]))\//';
            if (isset($config[$name]['host'])) {
                $this->baseUrl = preg_replace($expr, "$1://" . $config[$name]['host'] . "/",
                    $this->baseUrl);

            }
            if (isset($config[$name]['scheme'])) {
                $this->baseUrl = preg_replace($expr, $config[$name]['scheme'] . "://$2/",
                    $this->baseUrl);
            }
        }

        $return = parent::newUrlset($name, $lastmod,
            $gzExtension);

        $this->baseUrl = $default;

        return $return;
    }


}
