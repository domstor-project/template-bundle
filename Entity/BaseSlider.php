<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Domstor\TemplateBundle\Entity;

use Domstor\TemplateBundle\Model\SliderInterface;
use DateTime;
use Sonata\MediaBundle\Model\MediaInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Description of BaseSlider
 *
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 * @UniqueEntity("sorting")
 */
abstract class BaseSlider implements SliderInterface
{
    /**
     *
     * @var int 
     */
    protected $id;
    
    /**
     *
     * @var MediaInterface
     */
    protected $image;
    
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 1,
     *      max = 65000
     * )
     */
    protected $content;
    
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 1,
     *      max = 255
     * )
     */
    protected $contentFormatter;
    
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
    
    public function getId()
    {
        return $this->id;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getContentFormatter()
    {
        return $this->contentFormatter;
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

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function setContentFormatter($contentFormatter)
    {
        $this->contentFormatter = $contentFormatter;
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
    
    public function prePersist()
    {
        $this->setCreatedAt(new \DateTime());
        $this->setUpdatedAt(new \DateTime());
    }
    
    public function preUpdate()
    {
        $this->setUpdatedAt(new \DateTime());
    }
}
