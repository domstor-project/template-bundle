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
interface SliderInterface
{
    public function getId();

    public function getImage();

    public function getContent();

    public function getContentFormatter();

    public function getSorting();

    public function getCreatedAt();

    public function getUpdatedAt();

    public function setImage(MediaInterface $image);

    public function setContent($content);

    public function setContentFormatter($contentFormatter);

    public function setSorting($sorting);

    public function setCreatedAt(DateTime $createdAt);

    public function setUpdatedAt(DateTime $updatedAt);
}
