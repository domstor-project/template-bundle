<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Domstor\TemplateBundle\Entity;

use Domstor\TemplateBundle\Model\SpecialOfferInterface;
use Sonata\MediaBundle\Model\MediaInterface;
use DateTime;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Description of BaseSpecial
 *
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 * @UniqueEntity("sorting")
 */
abstract class BaseSpecialOffer implements SpecialOfferInterface
{   
    /**
     *
     * @var int 
     */
    protected $id;

    public function getId()
    {
        return $this->id;
    }
    
    /**
     *
     * @var MediaInterface 
     */
    protected $image;
    
    /**
     *
     * @var string 
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 1,
     *      max = 65000
     * )
     */
    protected $text;
    
    /**
     *
     * @var string 
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 1,
     *      max = 255
     * )
     */
    protected $address;
    
    /**
     *
     * @var string 
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 1,
     *      max = 255
     * )
     */
    protected $price;
    
    /**
     *
     * @var string 
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 1,
     *      max = 255
     * )
     */
    protected $link;
    
    /**
     *
     * @var int 
     * @Assert\NotBlank()
     */
    protected $sorting;
        
    /**
     *
     * @var DateTime 
     */
    protected $createdAt;
    
    /**
     *
     * @var DateTime 
     */
    protected $updatedAt;
    
    public function setImage(MediaInterface $image)
    {
        $this->image = $image;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setLink($link)
    {
        $this->link = $link;
    }

    public function setCreatedAt(DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function setUpdatedAt(DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    
    public function getSorting()
    {
        return $this->sorting;
    }

    public function setSorting($sorting)
    {
        $this->sorting = $sorting;
    }

        
    public function prePersist()
    {
        $dt = new DateTime();
        $this->setCreatedAt($dt);
        $this->setUpdatedAt($dt);
    }
    
    public function preUpdate()
    {
        $this->setUpdatedAt(new DateTime());
    }
}
