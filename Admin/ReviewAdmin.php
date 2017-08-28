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
            ->add('reviewDate')
            ->add('author')
            ->add('text')
        ;
    }
    
    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('id')
            ->add('reviewDate')
            ->add('author')
        ;
    }
}
