<?php


namespace WebEtDesign\SeoBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use WebEtDesign\CmsBundle\Entity\CmsPage;
use WebEtDesign\CmsBundle\Services\WDDeclinationService;
use WebEtDesign\MediaBundle\Entity\Media;
use WebEtDesign\MediaBundle\Services\WDMediaService;


class SeoTwigExtension extends AbstractExtension
{

    private                       $globalVars = null;
    private ParameterBagInterface $parameterBag;
    private WDMediaService        $mediaService;
    private WDDeclinationService  $declinationService;
    private HttpClientInterface   $client;
    private Environment $environment;

    public function __construct(
        ContainerInterface $container,
        ParameterBagInterface $parameterBag,
        WDMediaService $mediaService,
        WDDeclinationService $declinationService,
        HttpClientInterface $client,
        Environment $environment
    ) {
        $this->parameterBag       = $parameterBag;
        $this->mediaService       = $mediaService;
        $this->declinationService = $declinationService;
        $this->client             = $client;

        // TODO : refactor globalVar to not use container
        $cms_vars = $this->parameterBag->get('wd_cms.vars');
        if ($cms_vars['global_service']) {
            $this->globalVars = $container->get($cms_vars['global_service']);
        }
        $this->environment = $environment;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('wd_seo_render_value', [$this, 'renderSeoSmo']),
            new TwigFunction('wd_seo_pager_canonical', [$this, 'renderPagerCanonical']),
        ];
    }

    public function renderSeoSmo($object, $name, $default = null)
    {
        $method     = 'get' . ucfirst($name);
        $cms_config = $this->parameterBag->get('wd_cms.cms');
        $cms_vars   = $this->parameterBag->get('wd_cms.vars');

        $value = null;
        if ($object instanceof CmsPage && $cms_config['declination'] && ($declination = $this->declinationService->getDeclination($object))) {
            $value = $this->getSeoSmoValue($declination, $method);
            if (empty($value)) {
                $value = $this->getSeoSmoValueFallbackParentPage($object, $method);
            }
        } else {
            if ($object instanceof CmsPage) {
                $value = $this->getSeoSmoValueFallbackParentPage($object, $method);
            } else {
                $value = $this->getSeoSmoValue($object, $method);
            }
        }

        $value = !empty($value) ? $value : $default;

        if ($value instanceof Media) {
            $path = $this->mediaService->getImagePath($value, 'default');
            if (preg_match('/\/resolve\//', $path)) {
                $response = $this->client->request('GET', $path);
                if ($response->getStatusCode() !== 200) {
                    return null;
                }
                return $this->mediaService->getImagePath($value, 'default', 'xl');
            }

            return $path;
        }

        if ($cms_vars['enable']) {
            $value = $this->globalVars->replaceVars($value);
        }

        return $value;
    }

    /**
     * @param $pager
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     * @author Benjamin Robert
     */
    public function renderPagerCanonical($pager){
        if(str_contains(get_class($pager), 'Pagerfanta')){
                return $this->environment->render('@WDSeo/fanta_pager.html.twig', [
                    'pager' => $pager
                ]);
        }else if(str_contains(get_class($pager), 'Knp')){
            return $this->environment->render('@WDSeo/knp_pager.html.twig', [
                    'pager' => $pager
                ]);
        }
        return '';
    }

    private function getSeoSmoValueFallbackParentPage(CmsPage $object, $method)
    {
        $value = $this->getSeoSmoValue($object, $method);
        if (empty($value) && $object->getParent() !== null) {
            return $this->getSeoSmoValueFallbackParentPage($object->getParent(), $method);
        }

        return $value;
    }

    private function getSeoSmoValue($object, $method)
    {
        if (method_exists($object, $method)) {
            return call_user_func_array([$object, $method], []);
        } else {
            //            trigger_error('Call to undefined method ' . get_class($object) . '::' . $method . '()',
            //                E_USER_ERROR);
            return null;
        }
    }

}
