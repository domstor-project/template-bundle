<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Domstor\TemplateBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\FormatterBundle\Formatter\Pool as FormatterPool;
use Domstor\TemplateBundle\Model\PostInterface;
use Sonata\FormatterBundle\Form\Type\FormatterType;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\CoreBundle\Form\Type\DatePickerType;

/**
 * Description of PostAdmin
 *
 * @author Dmitry Anikeev <dm.anikeev@gmail.com>
 */
class PostAdmin extends AbstractAdmin
{
    /**
     * @var FormatterPool
     */
    protected $formatterPool;
    
    /**
     * @param FormatterPool $formatterPool
     */
    public function setPoolFormatter(FormatterPool $formatterPool)
    {
        $this->formatterPool = $formatterPool;
    }
    
    /**
     * {@inheritdoc}
     * @param PostInterface $post Description
     */
    public function prePersist($post)
    {
        $post->setContent($this->formatterPool->transform($post->getContentFormatter(), $post->getRawContent()));
    }
    
    /**
     * {@inheritdoc}
     */
    public function preUpdate($post)
    {
        $post->setContent($this->formatterPool->transform($post->getContentFormatter(), $post->getRawContent()));
    }
    
    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('enabled')
            ->add('title')
            ->add('content', null, array('safe' => true))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $subject = $this->getSubject();
        $format = 'rawhtml';
        if ($subject !== null && $subject->getId()!==null)
        {
            $format = $subject->getContentFormatter();
        }
        $isHorizontal = $this->getConfigurationPool()->getOption('form_type') == 'horizontal';
        $formMapper
            ->with('group_post', array(
                    'class' => 'col-md-8',
                ))
                ->add('title')
                ->add('content', FormatterType::class, array(
                    'event_dispatcher' => $formMapper->getFormBuilder()->getEventDispatcher(),
                    'format_field' => 'contentFormatter',
                    'source_field' => 'content',
                    'format_field_options' => array(
                        'choices' => ['rawhtml'=>'rawhtml', 'richhtml'=>'richhtml'],
                        'data'=>$format
                    ),
                    'source_field_options' => array(
                        'horizontal_input_wrapper_class' => $isHorizontal ? 'col-lg-12' : '',
                        'attr' => array('class' => $isHorizontal ? 'span10 col-sm-10 col-md-10' : '', 'rows' => 20),
                    ),
                    'ckeditor_context' => 'news',
                    'target_field' => 'content',
                    'listener' => true,
                ))
                ->add('image', ModelListType::class, array('required' => false), array(
                    'link_parameters' => array(
                        'context' => 'news',
                        'hide_context' => true,
                    ),
                ))
            ->end()
            ->with('group_status', array(
                    'class' => 'col-md-4',
                ))
                ->add('enabled', null, array('required' => false))
                ->add('publicationDateStart', DatePickerType::class)
            ->end()
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('title', 'string')
            ->add('publicationDateStart', 'date')
            ->add('enabled', 'boolean', [
                'editable' => true
            ])
        ;
    }

}
