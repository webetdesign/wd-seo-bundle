<?php


namespace WebEtDesign\SeoBundle\EventListener;


use DateTime;
use Doctrine\DBAL\Driver\PDO\Connection;
use Doctrine\ORM\EntityManagerInterface;
use PDO;
use Presta\SitemapBundle\Event\SitemapPopulateEvent;
use Presta\SitemapBundle\Service\UrlContainerInterface;
use Presta\SitemapBundle\Sitemap\Url\UrlConcrete;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class SitemapSubscriber implements EventSubscriberInterface
{

    /**
     * @var UrlGeneratorInterface
     */
    private UrlGeneratorInterface  $urlGenerator;
    private ParameterBagInterface  $parameterBag;
    private EntityManagerInterface $entityManager;

    /**
     * @param UrlGeneratorInterface $urlGenerator
     * @param ParameterBagInterface $parameterBag
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        UrlGeneratorInterface $urlGenerator,
        ParameterBagInterface $parameterBag,
        EntityManagerInterface $entityManager
    ) {
        $this->urlGenerator  = $urlGenerator;
        $this->parameterBag  = $parameterBag;
        $this->entityManager = $entityManager;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            SitemapPopulateEvent::ON_SITEMAP_POPULATE => 'populate',
        ];
    }

    /**
     * @param SitemapPopulateEvent $event
     */
    public function populate(SitemapPopulateEvent $event): void
    {
        $this->registerDynamicUrls($event->getUrlContainer());
    }

    private function registerDynamicUrls(UrlContainerInterface $urls)
    {
        $configs = $this->parameterBag->get('wd_seo.sitemap');
        /** @var Connection $con */
        $con = $this->entityManager->getConnection()->getWrappedConnection();

        foreach ($configs as $config) {
            $context = $this->urlGenerator->getContext();
            if (isset($config['host'])) {
                $context->setHost($config['host']);
            }
            if (isset($config['scheme'])) {
                $context->setScheme($config['scheme']);
            }
            $this->urlGenerator->setContext($context);

            $stmt = $con->prepare($config['query']);
            $stmt->execute($config['query_parameters'] ?? null);

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($results as $result) {
                $lastmod = null;
                if (isset($result['lastmod'])) {
                    $lastmod = DateTime::createFromFormat($config['parameters']['lastmod_foramt'] ?? 'Y-m-d H:i:s',
                        $result['lastmod']);
                } elseif (isset($config['parameters']['lastmod'])) {
                    $lastmod = DateTime::createFromFormat($config['parameters']['lastmod_foramt'] ?? 'Y-m-d H:i:s',
                        $config['parameters']['lastmod']);
                }

                $url = new UrlConcrete($this->urlGenerator->generate($config['route'], [],
                    UrlGeneratorInterface::ABSOLUTE_URL),
                    $lastmod,
                    $config['parameters']['changefreq'] ?? null,
                    $config['parameters']['priority'] ?? null
                );

                // TODO: add other lang

                $urls->addUrl($url, $config['section']);
            }

        }


    }

}
