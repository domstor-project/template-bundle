<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Domstor\TemplateBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Domstor\TemplateBundle\Model\BlockContentProviderInterface;

/**
 * Description of BaseEmployeeRepository
 *
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */
abstract class BaseEmployeeRepository extends EntityRepository implements BlockContentProviderInterface
{
    public function findForHomePage($options)
    {
        $qb = $this->createQueryBuilder('emp');
        $qb
            ->addSelect('image')
            ->leftJoin('emp.image', 'image')
            ->orderBy('emp.sorting', 'asc')
            ->setMaxResults($options['count'])
        ;
        return $qb->getQuery()->getResult();
    }
}
