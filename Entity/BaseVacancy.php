<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Domstor\TemplateBundle\Entity;

use Domstor\TemplateBundle\Model\VacancyInterface;
use DateTime;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * Description of BaseVacancy
 *
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 * @UniqueEntity("sorting")
 */
abstract class BaseVacancy implements VacancyInterface
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
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 1,
     *      max = 255
     * )
     */
    protected $title;
    
    /**
     *
     * @var string 
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 1,
     *      max = 255
     * )
     */
    protected $place;
    
    /**
     *
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 1,
     *      max = 255
     * )
     */
    protected $salary;
    
    /**
     *
     * @var string 
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 1,
     *      max = 255
     * )
     */
    protected $phone;
    
    /**
     *
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 1,
     *      max = 65000
     * )
     */
    protected $description;

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
    
    /**
     * @var string
     * @Assert\NotBlank()
     */
    protected $contentFormatter;
    
    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setPlace($place)
    {
        $this->place = $place;
    }

    public function setSalary($salary)
    {
        $this->salary = $salary;
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

    public function getTitle()
    {
        return $this->title;
    }

    public function getPlace()
    {
        return $this->place;
    }

    public function getSalary()
    {
        return $this->salary;
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
    
    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }
    
    public function getContentFormatter()
    {
        return $this->contentFormatter;
    }
    
    public function setContentFormatter($contentFormatter)
    {
        $this->contentFormatter = $contentFormatter;
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
