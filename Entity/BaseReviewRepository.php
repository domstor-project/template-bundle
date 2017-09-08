<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Domstor\TemplateBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Domstor\TemplateBundle\Model\BlockContentProviderInterface;
use Domstor\TemplateBundle\Model\ReviewProviderInterface;
use Knp\Bundle\PaginatorBundle\Definition\PaginatorAwareInterface;
use Knp\Component\Pager\Paginator;
use PDO;

/**
 * Description of BaseReviewRepository
 *
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */
abstract class BaseReviewRepository extends EntityRepository implements BlockContentProviderInterface, ReviewProviderInterface, PaginatorAwareInterface
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
        $qb = $this->createQueryBuilder('r');
        $qb
            ->orderBy('r.reviewDate', 'desc')
        ;
        return $qb->getQuery()->getResult();
    }
    
    public function findForListPage($page, $limit)
    {
        $qb = $this->createQueryBuilder('r');
        $qb
            ->orderBy('r.reviewDate', 'desc')
        ;        
        $query = $qb->getQuery();
        return $this->paginator->paginate($query, $page, $limit);
    }

    public function findForShowPage($id)
    {
        $qb = $this->createQueryBuilder('r');
        $qb
            ->where($qb->expr()->eq('r.id', ':id'))
            ->setParameter('id', $id, PDO::PARAM_INT)
        ;
        
        return $qb->getQuery()->getOneOrNullResult();
    }
}
