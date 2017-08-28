<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Domstor\TemplateBundle\Entity;

use Domstor\TemplateBundle\Model\PartnerInterface;
use Sonata\MediaBundle\Model\MediaInterface;
use DateTime;

/**
 * Description of BasePartner
 *
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */
abstract class BasePartner implements PartnerInterface
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
     */
    protected $name;

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

    public function getImage()
    {
        return $this->image;
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

    public function setImage(MediaInterface $image)
    {
        $this->image = $image;
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
    
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
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
