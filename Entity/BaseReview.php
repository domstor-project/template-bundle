<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Domstor\TemplateBundle\Entity;

use Domstor\TemplateBundle\Model\ReviewInterface;
use DateTime;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Description of BaseReview
 *
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */
abstract class BaseReview implements ReviewInterface
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
     *      max = 65000
     * )
     */
    protected $text;
    
    /**
     *
     * @var DateTime 
     * @Assert\NotNull()
     * @Assert\DateTime()
     */
    protected $reviewDate;
    
    /**
     *
     * @var string 
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 1,
     *      max = 255
     * )
     */
    protected $author;    
        
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

    public function setReviewDate(DateTime $reviewDate)
    {
        $this->reviewDate = $reviewDate;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
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

    public function getReviewDate()
    {
        return $this->reviewDate;
    }

    public function getAuthor()
    {
        return $this->author;
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
