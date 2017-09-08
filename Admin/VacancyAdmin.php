<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Domstor\TemplateBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\AbstractQuery;
use Sonata\FormatterBundle\Form\Type\FormatterType;

/**
 * Description of VacancyAdmin
 *
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */
class VacancyAdmin extends AbstractAdmin
{
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
            ->add('title')
            ->add('place')
            ->add('salary')
            ->add('phone')
            ->add('description', FormatterType::class, array(
                'event_dispatcher' => $formMapper->getFormBuilder()->getEventDispatcher(),
                'format_field' => 'contentFormatter',
                'source_field' => 'description',
                'format_field_options' => array(
                    'choices' => ['rawhtml'=>'rawhtml', 'richhtml'=>'richhtml'],
                    'data'=>$format
                ),
                'source_field_options' => array(
                    'horizontal_input_wrapper_class' => $isHorizontal ? 'col-lg-12' : '',
                    'attr' => array('class' => $isHorizontal ? 'span10 col-sm-10 col-md-10' : '', 'rows' => 20),
                ),
                'ckeditor_context' => 'vacancy',
                'target_field' => 'description',
                'listener' => true,
            ))
            ->add('sorting')
        ;
    }
    
    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('id')
            ->add('sorting', null, [
                'editable' => true
            ])
            ->add('title')
            ->add('place')
            ->add('salary')
            ->add('phone')
            
        ;
    }
}
