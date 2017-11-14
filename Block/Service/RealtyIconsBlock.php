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
use Sonata\BlockBundle\Model\BlockInterface;
use Domstor_Builder;
use Domstor_Helper;
use Domstor\TemplateBundle\Model\TitleProvider;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpKernel\Config\FileLocator;

/**
 * Description of RealtyIconsBlock
 *
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */
class RealtyIconsBlock extends AbstractBlockService
{
    protected $parameters = [];

    /**
     *
     * @var Domstor_Builder
     */
    protected $builder;

    /**
     *
     * @var FileLocator
     */
    protected $locator;

    /**
     *
     * @var TitleProvider
     */
    protected $provider;

    public function __construct($name, EngineInterface $templating, Domstor_Builder $builder, array $parameters, FileLocator $locator, TitleProvider $provider)
    {
        parent::__construct($name, $templating);
        $this->builder = $builder;
        $this->parameters = $parameters;
        $this->locator = $locator;
        $this->provider = $provider;
    }

    public function configureSettings(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
                'template' => 'DomstorTemplateBundle:Block:realtyicons.html.twig',
                'builder_location_id' => null
            ])
            ->setAllowedTypes('builder_location_id', ['null','string'])
        ;
    }

    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        $location_id = $blockContext->getSetting('builder_location_id');
        $contextSettings = $this->parameters;
        if ($location_id!==null && is_numeric($location_id))
        {
            $contextSettings['location_id'] = (int)$location_id;
        }

        $domstor = $this->builder->build($contextSettings);

        $countsLiv = $domstor->getAllCounts(['commerce' => false]);

        $countsCom = [];
        $object = 'commerce';
        $countsCom[$object] = [];
        foreach (Domstor_Helper::getActions($object) as $action)
        {
            $c = $domstor->getCount($object, $action);
            if ($c > 0)
            {
                $countsCom[$object][$action] = $c;
            }
        }

        return $this->renderResponse($blockContext->getTemplate(), [
                    'countsLiv' => $countsLiv,
                    'countsCom' => $countsCom,
                    'tp' => $this->provider,
        ]);
    }

}
