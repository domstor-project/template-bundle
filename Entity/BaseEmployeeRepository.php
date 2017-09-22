<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Domstor\TemplateBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Domstor\TemplateBundle\Model\BlockContentProviderInterface;
use Domstor\TemplateBundle\Model\EmployeeProviderInterface;
use Knp\Bundle\PaginatorBundle\Definition\PaginatorAwareInterface;
use Knp\Component\Pager\Paginator;
use PDO;

/**
 * Description of BaseEmployeeRepository
 *
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */
abstract class BaseEmployeeRepository extends EntityRepository implements BlockContentProviderInterface, EmployeeProviderInterface, PaginatorAwareInterface
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
        $qb = $this->createQueryBuilder('emp');
        $qb
            ->addSelect('image')
            ->leftJoin('emp.image', 'image')
            ->orderBy('emp.sorting', 'asc')
            ->setMaxResults($options['count'])
        ;
        return $qb->getQuery()->getResult();
    }
    
    public function findForListPage($page, $limit)
    {
        $qb = $this->createQueryBuilder('e');
        $qb
            ->addSelect('image')
            ->leftJoin('e.image', 'image')
            ->orderBy('e.sorting', 'asc')
        ;
        
        $query = $qb->getQuery();
        return $this->paginator->paginate($query, $page, $limit);
    }
    
    public function findForShowPage($id)
    {
        $qb = $this->createQueryBuilder('e');
        $qb
            ->addSelect('image')
            ->leftJoin('e.image', 'image')
            ->where($qb->expr()->eq('e.id', ':id'))
            ->setParameter('id', $id, PDO::PARAM_INT)
        ;        
        return $qb->getQuery()->getOneOrNullResult();
    }
}
