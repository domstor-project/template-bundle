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
                    'builder_location_id' => null,
                    'builder_filter_template_dir' => null,
                    'object' => 'flat',
                    'action' => 'sale',
                    'form_action_route_placeholders' => '?page=%page%sort%filter',
                ])
                ->setAllowedTypes('builder_filter_template_dir',['null', 'string'])
                ->setAllowedTypes('builder_location_id',['null', 'string'])
        ;
    }

    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        $contextSettings = $this->builderParameters;
        $templateDir = $blockContext->getSetting('builder_filter_template_dir');
        if (null!==$templateDir)
        {
            $contextSettings['filter']['template_dir'] = $this->locator->locate($templateDir);
        }
        $location_id = $blockContext->getSetting('builder_location_id');
        if ($location_id!==null && is_numeric($location_id))
        {
            $contextSettings['location_id'] = (int)$location_id;
        }
        $domstor = $this->builder->build($contextSettings);

        $filter = $domstor->createFilter($blockContext->getSetting('object'), $blockContext->getSetting('action'));
        $filter->setAction($this->router->generate($blockContext->getSetting('form_action_route'), [
                    'object' => $blockContext->getSetting('object'),
                    'action' => $blockContext->getSetting('action'),
                ]) . $blockContext->getSetting('form_action_route_placeholders'));
        return $this->renderResponse($blockContext->getTemplate(), [
                    'filter' => $filter
        ]);
    }

}
