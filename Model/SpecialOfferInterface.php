<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Domstor\TemplateBundle\Model;

use Sonata\MediaBundle\Model\MediaInterface;
use DateTime;

/**
 *
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */
interface SpecialOfferInterface
{
    public function setImage(MediaInterface $image);

    public function setText($text);

    public function setAddress($address);

    public function setPrice($price);

    public function setLink($link);

    public function setCreatedAt(DateTime $createdAt);

    public function setUpdatedAt(DateTime $updatedAt);

    public function getId();

    public function getImage();

    public function getText();

    public function getAddress();

    public function getPrice();

    public function getLink();
    
    public function getSorting();

    public function setSorting($sorting);

    public function getCreatedAt();

    public function getUpdatedAt();
}
