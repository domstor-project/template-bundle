<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Domstor\TemplateBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Domstor\TemplateBundle\Model\BlockContentProviderInterface;
use Domstor\TemplateBundle\Model\UrgentSaleProviderInterface;
use Knp\Component\Pager\Paginator;
use Knp\Bundle\PaginatorBundle\Definition\PaginatorAwareInterface;
use PDO;

/**
 * Description of BaseUrgentSaleRepository
 *
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */
abstract class BaseUrgentSaleRepository extends EntityRepository implements BlockContentProviderInterface, UrgentSaleProviderInterface, PaginatorAwareInterface
{
    /**
     *
     * @var Paginator 
     */
    protected $paginator;

    public function setPaginator(Paginator $paginator)
    {
        $this->paginator = $paginator;
    }
    
    public function findForHomePage($options)
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            ->orderBy('s.sorting', 'asc')
            ->setMaxResults($options['count'])
        ;
        return $qb->getQuery()->getResult();
    }
    
    public function findForListPage($page, $limit)
    {
        $qb = $this->createQueryBuilder('u');
        
        $query = $qb->getQuery();
        return $this->paginator->paginate($query, $page, $limit);
    }

    public function findForShowPage($id)
    {
        $qb = $this->createQueryBuilder('u');
        $qb
            ->where($qb->expr()->eq('u.id', ':id'))
            ->setParameter('id', $id, PDO::PARAM_INT)
        ;
        
        return $qb->getQuery()->getOneOrNullResult();
    }
}
