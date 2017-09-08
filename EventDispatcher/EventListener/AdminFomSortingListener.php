<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Domstor\TemplateBundle\EventDispatcher\EventListener;

use Sonata\AdminBundle\Event\ConfigureEvent;

/**
 * Description of AdminFomSortingListener
 *
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */
class AdminFomSortingListener
{
    public function onFomConfigureEvent(ConfigureEvent $event)
    {
        if ($event->getAdmin()->getFormBuilder()->has('sorting'))
        {
            var_dump('azaza');
//            $form = $event->getAdmin()->getForm();
//            $className = $event->getAdmin()->getClass();
//            $qb =  $event->getAdmin()->getModelManager()->getEntityManager($className)->createQueryBuilder();
//            /* @var $qb QueryBuilder */
//            $qb
//                ->select($qb->expr()->max('o.sorting'))
//                ->from($this->getClass(), 'o')            
//            ;           
//
//            $res = $qb->getQuery()->getOneOrNullResult(AbstractQuery::HYDRATE_SINGLE_SCALAR);
//            $entity = $event->getAdmin()->getSubject();
//            if ($entity->getId()===null)
//            {
//                $val = $res === null ? 0 : ++$res;
//            }
//            else
//            {
//                $val = $entity->getSorting();
//            }
//            $form->get('sorting')->setData($val);
        }
    }
}
