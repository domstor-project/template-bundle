<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Domstor\TemplateBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Domstor\TemplateBundle\Model\BlockContentProviderInterface;
use Domstor\TemplateBundle\Model\VacancyProviderInterface;
use Knp\Component\Pager\Paginator;
use PDO;
use Knp\Bundle\PaginatorBundle\Definition\PaginatorAwareInterface;

/**
 * Description of BaseVacancyRepository
 *
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */
class BaseVacancyRepository extends EntityRepository implements BlockContentProviderInterface, VacancyProviderInterface, PaginatorAwareInterface
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
        $qb = $this->createQueryBuilder('v');
        
        $query = $qb->getQuery();
        return $this->paginator->paginate($query, $page, $limit);
    }

    public function findForShowPage($id)
    {
        $qb = $this->createQueryBuilder('v');
        $qb
            ->where($qb->expr()->eq('v.id', ':id'))
            ->setParameter('id', $id, PDO::PARAM_INT)
        ;
        
        return $qb->getQuery()->getOneOrNullResult();
    }
}
