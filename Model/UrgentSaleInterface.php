<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Domstor\TemplateBundle\Model;

use DateTime;

/**
 *
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */
interface UrgentSaleInterface
{
    public function setText($text);

    public function setAddress($address);

    public function setPrice($price);

    public function setPhone($phone);

    public function setSorting($sorting);

    public function setCreatedAt(DateTime $createdAt);

    public function setUpdatedAt(DateTime $updatedAt);

    public function getId();

    public function getText();

    public function getAddress();

    public function getPrice();

    public function getPhone();

    public function getSorting();

    public function getCreatedAt();

    public function getUpdatedAt();
    
    public function getLink();

    public function setLink($link);
}
