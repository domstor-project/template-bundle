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

/**
 * Description of VacancyAdmin
 *
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */
class VacancyAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('title')
            ->add('place')
            ->add('salary', NumberType::class)
            ->add('phone')
            ->add('sorting')
        ;
    }
    
    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('id')
            ->add('title')
            ->add('place')
            ->add('salary')
            ->add('phone')
            ->add('sorting')
        ;
    }
}
