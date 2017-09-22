<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Domstor\TemplateBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Domstor\TemplateBundle\Model\BlockContentProviderInterface;
use Domstor\TemplateBundle\Model\SpecialOfferProviderInterface;
use Knp\Bundle\PaginatorBundle\Definition\PaginatorAwareInterface;
use Knp\Component\Pager\Paginator;
use PDO;

/**
 * Description of BaseSpecialOfferRepository
 *
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */
abstract class BaseSpecialOfferRepository extends EntityRepository implements BlockContentProviderInterface, SpecialOfferProviderInterface, PaginatorAwareInterface
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
            ->addSelect('image')
            ->leftJoin('s.image', 'image')
            ->orderBy('s.sorting', 'asc')
            ->setMaxResults($options['count'])
        ;
        return $qb->getQuery()->getResult();
    }
    
    public function findForListPage($page, $limit)
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            ->addSelect('image')
            ->leftJoin('s.image', 'image')
            ->orderBy('s.sorting', 'asc')
        ;        
        $query = $qb->getQuery();
        return $this->paginator->paginate($query, $page, $limit);
    }

    public function findForShowPage($id)
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            ->where($qb->expr()->eq('s.id', ':id'))
            ->setParameter('id', $id, PDO::PARAM_INT)
        ;
        
        return $qb->getQuery()->getOneOrNullResult();
    }
}
