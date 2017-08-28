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

/**
 * Description of RealtyIconsBlock
 *
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */
class RealtyIconsBlock extends AbstractBlockService
{    
    protected $defaultTemplate;
    
    protected $orgId;
    
    protected $locationId;
    
    protected $cacheDir;

    public function configureSettings(OptionsResolver $resolver)
    {
        $resolver
            ->setRequired(['template', 'org_id', 'location_id'])
        ;
        if ($this->defaultTemplate!==null)
        {
            $resolver->setDefault('template', $this->defaultTemplate);
        }
        if ($this->orgId!==null)
        {
            $resolver->setDefault('org_id', $this->orgId);
        }
        if ($this->locationId!==null)
        {
            $resolver->setDefault('location_id', $this->locationId);
        }
    }
    
    public function setTemplate($template)
    {
        $this->defaultTemplate = $template;
    }
    
    public function setOrgId($orgId)
    {
        $this->orgId = (int)$orgId;
    }
    
    public function setLocationId($locationId)
    {
        $this->locationId = (int)$locationId;
    }
    
    public function setCacheDir($cacheDir)
    {
        $this->cacheDir = $cacheDir;
    }

    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        $builder = new Domstor_Builder();
        $domstor = $builder->build(array(
            'org_id' => $this->orgId,
            'location_id' => $this->locationId,
            'cache' => array(
                'type' => 'file',
                'time' => 86400,
                'uniq_key' => (string)$this->orgId,
                'options' => array('directory' => $this->cacheDir),
            ),
        ));

        $countsLiv = $domstor->getAllCounts(array('commerce' => false));
        //$countsCom = $domstor->getAllCounts(array('living' => false));

        $countsCom = [];
        $object = 'commerce';
        $countsCom[$object] = array();
        foreach (Domstor_Helper::getActions($object) as $action) {
            $c = $domstor->getCount($object, $action);
            if ($c > 0 || $s['with_empty']) {
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
