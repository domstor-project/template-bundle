<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Domstor\TemplateBundle\Entity;

use DateTime;
use Domstor\TemplateBundle\Model\PostInterface;
use Sonata\MediaBundle\Model\MediaInterface;

/**
 * Description of Post
 *
 * @author Dmitry Anikeev <dm.anikeev@gmail.com>
 */
abstract class BasePost implements PostInterface
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
     * @var string
     */
    protected $title;
    
    /**
     *
     * @var MediaInterface 
     */
    protected $image;
    
    /**
     * @var bool
     */
    protected $enabled;
    
    /**
     * @var DateTime
     */
    protected $publicationDateStart;
    
    /**
     * @var DateTime
     */
    protected $createdAt;
    
    /**
     * @var DateTime
     */
    protected $updatedAt;    
    
    /**
     * @var string
     */
    protected $content;
    
    /**
     * @var string
     */
    protected $rawContent;
    
    /**
     * @var string
     */
    protected $contentFormatter;
    
    public function __construct()
    {
        $this->setPublicationDateStart(new DateTime());
    }
    
    public function getTitle()
    {
        return $this->title;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getEnabled()
    {
        return $this->enabled;
    }

    public function getPublicationDateStart()
    {
        return $this->publicationDateStart;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    public function setPublicationDateStart(DateTime $publicationDateStart)
    {
        $this->publicationDateStart = $publicationDateStart;
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

    public function setImage(MediaInterface $image)
    {
        $this->image = $image;
    }
    
    public function getRawContent()
    {
        return $this->rawContent;
    }

    public function getContentFormatter()
    {
        return $this->contentFormatter;
    }

    public function setRawContent($rawContent)
    {
        $this->rawContent = $rawContent;
    }

    public function setContentFormatter($contentFormatter)
    {
        $this->contentFormatter = $contentFormatter;
    }
    
    public function prePersist()
    {
        if (!$this->getPublicationDateStart()) {
            $this->setPublicationDateStart(new \DateTime());
        }
        $this->setCreatedAt(new \DateTime());
        $this->setUpdatedAt(new \DateTime());
    }
    
    public function preUpdate()
    {
        if (!$this->getPublicationDateStart()) {
            $this->setPublicationDateStart(new \DateTime());
        }
        $this->setUpdatedAt(new \DateTime());
    }
}
