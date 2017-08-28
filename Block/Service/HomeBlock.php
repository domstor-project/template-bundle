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
use Domstor\TemplateBundle\Model\BlockContentProviderInterface;
use Sonata\BlockBundle\Model\BlockInterface;

/**
 * Description of HomeBlock
 *
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */
class HomeBlock extends AbstractBlockService
{
    /**
     *
     * @var BlockContentProviderInterface 
     */
    protected $blockContentProvider;
    
    protected $defaultTemplate;

    public function configureSettings(OptionsResolver $resolver)
    {
        $resolver
            ->setRequired(['template'])
            ->setDefaults([
                'count'=>50
            ])
        ;
        if ($this->defaultTemplate!==null)
        {
            $resolver->setDefault('template', $this->defaultTemplate);
        }
    }
    
    public function setBlockContentProvider(BlockContentProviderInterface $blockContentProvider)
    {
        $this->blockContentProvider = $blockContentProvider;
    }
    
    public function setTemplate($template)
    {
        $this->defaultTemplate = $template;
    }

    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        $options = [
            'count'=>$blockContext->getSetting('count')
        ];
        return $this->renderResponse($blockContext->getTemplate(), [
            'rows'=>$this->blockContentProvider->findForHomePage($options)
        ]);
    }
}
