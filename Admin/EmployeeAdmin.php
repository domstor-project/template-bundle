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
 * Description of EmployeeAdmin
 *
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */
class EmployeeAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('image', ModelListType::class, array('required' => false), array(
                'link_parameters' => array(
                    'context' => 'employee',
                    'hide_context' => true,
                ),
            ))
            ->add('name')
            ->add('duty')
            ->add('phone')
            ->add('email')
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
            ->add('image')
            ->add('name')
            ->add('duty')
            ->add('phone')
            ->add('email')
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
