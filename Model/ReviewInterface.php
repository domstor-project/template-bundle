<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Domstor\TemplateBundle\Model;

use DateTime;

/**
 *
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */
interface ReviewInterface
{
    public function setText($text);

    public function setReviewDate(DateTime $reviewDate);

    public function setAuthor($author);

    public function setCreatedAt(DateTime $createdAt);

    public function setUpdatedAt(DateTime $updatedAt);

    public function getId();

    public function getText();

    public function getReviewDate();

    public function getAuthor();

    public function getCreatedAt();

    public function getUpdatedAt();
}
