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
use Symfony\Component\Form\Extension\Core\Type\UrlType;

/**
 * Description of UrgentSaleAdmin
 *
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */
class UrgentSaleAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('text')
            ->add('address')
            ->add('price')
            ->add('phone')
            ->add('link', UrlType::class)
            ->add('sorting')
        ;
    }
    
    protected function configureListFields(ListMapper $list)
    {
        $list
            ->add('_action', null, array(
                'actions' => array(
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
            ->addIdentifier('id')
            ->add('sorting', null, [
                'editable' => true
            ])
            ->add('address')
            ->add('price')
            ->add('phone')
            ->add('link', 'url')
        ;
    }
}
