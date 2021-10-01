<?php

namespace WebEtDesign\SeoBundle\Admin;

use Sonata\AdminBundle\Form\Type\ModelListType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use WebEtDesign\MediaBundle\Form\Type\WDMediaType;

trait SmoOpenGraphAdminTrait
{
    public function addFormFieldSmoOpenGraph($formMapper)
    {
        $formMapper
            ->with('wd_seo.form.seo.open_graph',
                ['class' => 'col-xs-12 col-md-4', 'box_class' => ''])
            ->add('og_title', TextType::class, [
                'label'    => 'wd_seo.form.og_title.label',
                'required' => false

            ])
            ->add('og_type', TextType::class, [
                'label'    => 'wd_seo.form.og_type.label',
                'required' => false

            ])
            ->add('og_description', TextareaType::class, [
                'label'    => 'wd_seo.form.og_description.label',
                'required' => false

            ])
            ->add('og_site_name', TextType::class, [
                'label'    => 'wd_seo.form.og_site_name.label',
                'required' => false

            ])
            ->add('og_image', WDMediaType::class, [
                'category' => 'SEO',
                'required' => false
            ])
            ->end();
    }

    public function addShowFieldSmoOpenGraph($formMapper)
    {
        $formMapper
            ->with('wd_seo.form.seo.open_graph',
                ['class' => 'col-xs-12 col-md-4', 'box_class' => ''])
            ->add('og_title', null, ['label' => 'wd_seo.form.og_title.label'])
            ->add('og_type', null, ['label' => 'wd_seo.form.og_type.label'])
            ->add('og_url', null, ['label' => 'wd_seo.form.og_url.label'])
            ->add('og_image', null, ['label' => 'wd_seo.form.og_image.label'])
            ->add('og_description', null, ['label' => 'wd_seo.form.og_description.label'])
            ->add('og_site_name', null, ['label' => 'wd_seo.form.og_site_name.label'])
            ->add('og_admins', null, ['label' => 'wd_seo.form.og_admins.label'])
            ->end();
    }
}
