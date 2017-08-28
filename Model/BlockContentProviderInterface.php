<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Domstor\TemplateBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;

/**
 *
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */
interface BlockContentProviderInterface
{
    /**
     * @return ArrayCollection Description
     */
    public function findForHomePage($options);
}
