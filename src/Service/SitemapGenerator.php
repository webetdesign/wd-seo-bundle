<?php


namespace WebEtDesign\SeoBundle\Service;


use Presta\SitemapBundle\Service\Generator;
use Presta\SitemapBundle\Sitemap\Urlset;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class SitemapGenerator extends Generator
{
    protected ParameterBagInterface $parameterBag;

    public function __construct(
        EventDispatcherInterface $dispatcher,
        UrlGeneratorInterface $router,
        ParameterBagInterface $parameterBag,
        int $itemsBySet = null
    )
    {
        $this->parameterBag = $parameterBag;
        parent::__construct($dispatcher, $router, $itemsBySet);
    }


    protected function newUrlset(string $name, \DateTimeInterface $lastmod = null): Urlset
    {
        $config = $this->parameterBag->get('wd_seo.section_config');
        $default_context = $this->router->getContext();


        if (isset($config[$name])) {
            $context = $this->router->getContext();
            if (isset($config[$name]['host'])) {
                $context->setHost($config[$name]['host']);
            }
            if (isset($config[$name]['scheme'])) {
                $context->setScheme($config[$name]['scheme']);
            }
            $this->router->setContext($context);
        }

        $return = parent::newUrlset($name, $lastmod);

        $this->router->setContext($default_context);

        return $return;
    }
}
