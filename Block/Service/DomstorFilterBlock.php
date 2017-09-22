<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Domstor\TemplateBundle\Block\Service;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Block\Service\AbstractBlockService;
use Domstor_Builder;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\HttpKernel\Config\FileLocator;

/**
 * Description of DomstorFilterBlock
 *
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */
class DomstorFilterBlock extends AbstractBlockService
{
    protected $builderParameters = [];

    /**
     *
     * @var Domstor_Builder 
     */
    protected $builder;

    /**
     *
     * @var Router 
     */
    protected $router;
    
    /**
     *
     * @var FileLocator 
     */
    protected $locator;

    public function __construct($name, EngineInterface $templating, Domstor_Builder $builder, array $parameters, Router $router, FileLocator $locator)
    {
        parent::__construct($name, $templating);
        $this->builder = $builder;
        $this->builderParameters = $parameters;
        $this->router = $router;
        $this->locator = $locator;
    }

    public function configureSettings(OptionsResolver $resolver)
    {
        $resolver
                ->setRequired([
                    'form_action_route'
                ])
                ->setDefaults([
                    'template' => 'DomstorTemplateBundle:Block:domstor_filter.html.twig',
                    'object' => 'flat',
                    'action' => 'sale',
                    'form_action_route_placeholders' => '?page=%page%sort%filter',
                    'filter_template_dir' => null
                ])
        ;
    }

    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        $filterDir = $this->locator->locate($blockContext->getSetting('filter_template_dir') ? $blockContext->getSetting('filter_template_dir') : $this->builderParameters['filter_template_dir']);
        $domstor = $this->builder->build([
            'org_id' => $this->builderParameters['org_id'],
            'location_id' => $this->builderParameters['location_id'],
            'cache' => [
                'type' => $this->builderParameters['cache_type'],
                'time' => $this->builderParameters['cache_time'],
                'uniq_key' => (string) $this->builderParameters['org_id'],
                'options' => ['directory' => $this->locator->locate($this->builderParameters['cache_dir']),
                ],
                'filter' => [
                    'template_dir' => $filterDir,
                ]
            ]
        ]);
        $filter = $domstor->createFilter($blockContext->getSetting('object'), $blockContext->getSetting('action'), ['filter_dir'=>$filterDir]);
        $filter->setAction($this->router->generate($blockContext->getSetting('form_action_route'), [
                    'object' => $blockContext->getSetting('object'),
                    'action' => $blockContext->getSetting('action'),
                ]) . $blockContext->getSetting('form_action_route_placeholders'));
        return $this->renderResponse($blockContext->getTemplate(), [
                    'filter' => $filter
        ]);
    }

}
