<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Domstor\TemplateBundle\Entity;

use Domstor\TemplateBundle\Model\UrgentSaleInterface;
use DateTime;

/**
 * Description of BaseUrgent
 *
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */
abstract class BaseUrgentSale implements UrgentSaleInterface
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
     * @var string 
     */
    protected $text;
    
    /**
     *
     * @var string 
     */
    protected $address;
    
    /**
     *
     * @var decimal 
     */
    protected $price;
    
    /**
     *
     * @var string 
     */
    protected $phone;
    
    /**
     *
     * @var int 
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

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function setSorting($sorting)
    {
        $this->sorting = $sorting;
    }

    public function setCreatedAt(DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function setUpdatedAt(DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
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

    public function getPhone()
    {
        return $this->phone;
    }

    public function getSorting()
    {
        return $this->sorting;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
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
