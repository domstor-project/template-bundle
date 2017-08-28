<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Domstor\TemplateBundle\Model;

use DateTime;
use Sonata\MediaBundle\Model\MediaInterface;

/**
 *
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */
interface EmployeeInterface
{
    public function getId();

    public function getImage();

    public function getName();

    public function getDuty();

    public function getPhone();

    public function getEmail();

    public function getSorting();

    public function getCreatedAt();

    public function getUpdatedAt();

    public function setImage(MediaInterface $image);

    public function setName($name);

    public function setDuty($duty);

    public function setPhone($phone);

    public function setEmail($email);

    public function setSorting($sorting);

    public function setCreatedAt(DateTime $createdAt);

    public function setUpdatedAt(DateTime $updatedAt);
}
