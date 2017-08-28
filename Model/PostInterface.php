<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Domstor\TemplateBundle\Model;

use DateTime;
use Sonata\MediaBundle\Model\MediaInterface;
use Sonata\FormatterBundle\Formatter\FormatterInterface;

/**
 *
 * @author Dmitry Anikeev <dm.anikeev@gmail.com>
 */
interface PostInterface
{
    public function getId();
    public function getTitle();
    public function getContent();
    public function getEnabled();
    public function getPublicationDateStart();
    public function getCreatedAt();
    public function getUpdatedAt();
    public function setTitle($title);
    public function setContent($content);
    public function setEnabled($enabled);
    public function setPublicationDateStart(DateTime $publicationDateStart);
    public function setCreatedAt(DateTime $createdAt);
    public function setUpdatedAt(DateTime $updatedAt);
    public function getImage();
    public function setImage(MediaInterface $image);
    public function getRawContent();
    public function getContentFormatter();
    public function setRawContent($rawContent);
    public function setContentFormatter($contentFormatter);
}
