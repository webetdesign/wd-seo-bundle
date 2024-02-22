<?php

namespace WebEtDesign\SeoBundle\Admin;

use Presta\SitemapBundle\Sitemap\Url\UrlConcrete;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Translation\TranslatableMessage;
use Symfony\Component\Validator\Constraints\Range;

trait SeoSitemapFieldAdminTrait
{
    public function addFormFieldSitemap($formMapper, $translationDomain = 'wd_seo'): void
    {
        $formMapper
            ->add('seoSitemapPriority', NumberType::class, [
                'label'              => new TranslatableMessage('wd_seo.form.seo_sitemap_priority.label', [], $translationDomain),
                'required'           => false,
                'html5'              => true,
                'scale'              => 1,
                'attr'               => [
                    'min'  => 0,
                    'max'  => 1,
                    'step' => 0.1,
                ],
                'constraints'        => [
                    new Range(min: 0, max: 1)
                ],
            ])
            ->add('seoSitemapChangeFreq', ChoiceType::class, [
                'label'                     => new TranslatableMessage('wd_seo.form.seo_sitemap_change_freq.label', [], $translationDomain),
                'required'                  => false,
                'choices'                   => [
                    'wd_seo.form.seo_sitemap_change_freq.always'  => UrlConcrete::CHANGEFREQ_ALWAYS,
                    'wd_seo.form.seo_sitemap_change_freq.hourly'  => UrlConcrete::CHANGEFREQ_HOURLY,
                    'wd_seo.form.seo_sitemap_change_freq.daily'   => UrlConcrete::CHANGEFREQ_DAILY,
                    'wd_seo.form.seo_sitemap_change_freq.weekly'  => UrlConcrete::CHANGEFREQ_WEEKLY,
                    'wd_seo.form.seo_sitemap_change_freq.monthly' => UrlConcrete::CHANGEFREQ_MONTHLY,
                    'wd_seo.form.seo_sitemap_change_freq.yearly'  => UrlConcrete::CHANGEFREQ_YEARLY,
                    'wd_seo.form.seo_sitemap_change_freq.never'   => UrlConcrete::CHANGEFREQ_NEVER,
                ],
                'choice_translation_domain' => $translationDomain,
            ]);
    }
}
