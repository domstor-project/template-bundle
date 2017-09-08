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
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Sonata\CoreBundle\Form\Type\DatePickerType;

/**
 * Description of ReviewAdmin
 *
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */
class ReviewAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form)
    {
        $form            
            ->add('reviewDate', DatePickerType::class)
            ->add('author')
            ->add('text', TextareaType::class)
        ;
    }
    
    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('id')
            ->add('reviewDate', 'date')
            ->add('author')
        ;
    }
}
