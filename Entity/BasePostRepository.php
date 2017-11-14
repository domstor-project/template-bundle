<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Domstor\TemplateBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Domstor\TemplateBundle\Model\BlockContentProviderInterface;
use Domstor\TemplateBundle\Model\PostProviderInterface;
use Knp\Bundle\PaginatorBundle\Definition\PaginatorAwareInterface;
use Knp\Component\Pager\Paginator;
use PDO;

/**
 * Description of BasePostRepository
 *
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */
abstract class BasePostRepository extends EntityRepository implements BlockContentProviderInterface, PostProviderInterface, PaginatorAwareInterface
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
        $qb = $this->createQueryBuilder('p');
        $qb
            ->addSelect('image')
            ->leftJoin('p.image', 'image')
            ->where('p.enabled = 1')
            ->orderBy('p.publicationDateStart', 'desc')
            ->setMaxResults($options['count'])
        ;
        return $qb->getQuery()->getResult();
    }
    
    public function findForListPage($page, $limit)
    {
        $qb = $this->createQueryBuilder('p');
        $qb
            ->addSelect('image')
            ->leftJoin('p.image', 'image')
            ->where('p.enabled = 1')
            ->orderBy('p.publicationDateStart', 'desc')
        ;
        
        $query = $qb->getQuery();
        return $this->paginator->paginate($query, $page, $limit);
    }
    
    public function findForShowPage($id)
    {
        $qb = $this->createQueryBuilder('p');
        $qb
            ->addSelect('image')
            ->leftJoin('p.image', 'image')
            ->where($qb->expr()->eq('p.id', ':id'))
            ->andWhere('p.enabled = 1')
            ->setParameter('id', $id, PDO::PARAM_INT)
        ;        
        return $qb->getQuery()->getOneOrNullResult();
    }
}
