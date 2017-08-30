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

/**
 * Description of RealtyIconsBlock
 *
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */
class RealtyIconsBlock extends AbstractBlockService
{    
    protected $parameters = [];
    
    public function __construct($name, EngineInterface $templating, array $parameters)
    {
        parent::__construct($name, $templating);
        $this->parameters = $parameters;
    }

    public function configureSettings(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
                'org_id'=>1,
                'location_id'=>2004,
                'template'=>'DomstorTemplateBundle:Block:realtyicons.html.twig',
                'cache_time'=> 86400,
                'cache_type'=>'file',
                'cache_dir'=>''
            ])
        ;
    }
    
    public function load(BlockInterface $block)
    {
        $block->setSettings($this->parameters);
    }

    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        $block = $blockContext->getBlock();
        $builder = new Domstor_Builder();
        $domstor = $builder->build([
            'org_id' =>$block->getSetting('org_id'),
            'location_id' => $block->getSetting('location_id'),
            'cache' => [
                'type' => $block->getSetting('cache_type'),
                'time' => $block->getSetting('cache_time'),
                'uniq_key' => (string)$block->getSetting('org_id'),
                'options' => ['directory' => $block->getSetting('cache_dir')],
            ],
        ]);

        $countsLiv = $domstor->getAllCounts(['commerce' => false]);

        $countsCom = [];
        $object = 'commerce';
        $countsCom[$object] = [];
        foreach (Domstor_Helper::getActions($object) as $action) {
            $c = $domstor->getCount($object, $action);
            if ($c > 0) {
                $countsCom[$object][$action] = $c;
            }
        }
        
        return $this->renderResponse($blockContext->getTemplate(), [
            'countsLiv' => $countsLiv,
            'countsCom' => $countsCom,
            'tp' => new TitleProvider($domstor),
        ]);
    }
}
