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
                    'org_id' => null,
                    'location_id' => null,
                    'template' => 'DomstorTemplateBundle:Block:realtyicons.html.twig',
                    'cache_time' => null,
                    'cache_type' => null,
                    'cache_dir' => null
                ])
        ;
    }

    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        $contextSettings = $blockContext->getSettings();
        $cacheDir = $this->locator->locate($contextSettings['cache_dir'] ? $contextSettings['cache_dir'] : $this->parameters['cache_dir']);
        $domstor = $this->builder->build([
            'org_id' => $contextSettings['org_id'] ? $contextSettings['org_id'] : $this->parameters['org_id'],
            'location_id' => $contextSettings['location_id'] ? $contextSettings['location_id'] : $this->parameters['location_id'],
            'cache' => [
                'type' => $contextSettings['cache_type'] ? $contextSettings['cache_type'] : $this->parameters['cache_type'],
                'time' => $contextSettings['cache_time'] ? $contextSettings['cache_time'] : $this->parameters['cache_time'],
                'uniq_key' => $contextSettings['org_id'] ? (string) $contextSettings['org_id'] : (string) $this->parameters['org_id'],
                'options' => ['directory' => $cacheDir],
            ],
        ]);

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
