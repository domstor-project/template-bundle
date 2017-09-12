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
use Domstor\TemplateBundle\Model\SliderInterface;
use Sonata\FormatterBundle\Form\Type\FormatterType;
use Sonata\AdminBundle\Form\Type\ModelListType;

/**
 * Description of SliderAdmin
 *
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */
class SliderAdmin extends AbstractAdmin
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
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('sorting')
            ->add('image')
            ->add('content', null, array('safe' => true))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $isHorizontal = $this->getConfigurationPool()->getOption('form_type') == 'horizontal';
        $formMapper
            ->with('group_content', array(
                    'class' => 'col-md-8',
                ))
                ->add('image', ModelListType::class, array('required' => false), array(
                    'link_parameters' => array(
                        'context' => 'slider',
                        'hide_context' => true,
                    ),
                ))
                ->add('content', FormatterType::class, array(
                    'event_dispatcher' => $formMapper->getFormBuilder()->getEventDispatcher(),
                    'format_field'   => 'contentFormatter',
                    'format_field_options' => array(
                        'choices' => ['rawhtml'=>'rawhtml'],
                        'data'=>'rawhtml'
                    ),
                    'source_field'   => 'content',
                    'listener'       => true,
                    'target_field'   => 'content',
                    'source_field_options' => array(
                        'horizontal_input_wrapper_class' => $isHorizontal ? 'col-lg-12' : '',
                        'attr' => array('class' => $isHorizontal ? 'span10 col-sm-10 col-md-10' : '', 'rows' => 20),
                    ),
                    'ckeditor_context' => 'slider'
                ))
            ->end()
            ->with('group_view', array(
                    'class' => 'col-md-4',
                ))
                ->add('sorting')
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
            ->add('sorting', null, [
                'editable' => true
            ])
            ->add('image')
            ->add('content', 'html')
        ;
    }
}
