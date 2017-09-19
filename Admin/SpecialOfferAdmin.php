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
use Sonata\AdminBundle\Form\Type\ModelListType;

/**
 * Description of SpecialOfferAdmin
 *
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */
class SpecialOfferAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('image', ModelListType::class, array('required' => false), array(
                'link_parameters' => array(
                    'context' => 'special_offer',
                    'hide_context' => true,
                ),
            ))
            ->add('text')
            ->add('address')
            ->add('price')
            ->add('link')
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
            ->add('image')
            ->add('address')
            ->add('price')
            ->add('link')
        ;
    }
    
    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $aliases = $query->getRootAliases();
        $query
            ->addSelect('image')
            ->leftJoin($aliases[0] . '.image', 'image')
        ;
        return $query;
    }
}
