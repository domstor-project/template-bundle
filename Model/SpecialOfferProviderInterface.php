<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Domstor\TemplateBundle\Model;

use Domstor\TemplateBundle\Model\SpecialOfferInterface;
use Knp\Component\Pager\Pagination\AbstractPagination;

/**
 *
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */
interface SpecialOfferProviderInterface
{
    /**
     * 
     * @param int $page
     * @param int $limit
     * @return AbstractPagination
     */
    public function findForListPage($page, $limit);
    
    /**
     * 
     * @param int $id
     * @return SpecialOfferInterface|null Description
     */
    public function findForShowPage($id);
}
