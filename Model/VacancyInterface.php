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
interface VacancyInterface
{
    public function setTitle($title);

    public function setPlace($place);

    public function setSalary($salary);

    public function setPhone($phone);

    public function setSorting($sorting);

    public function setCreatedAt(DateTime $createdAt);

    public function setUpdatedAt(DateTime $updatedAt);
    
    public function setDescription($description);

    public function getId();

    public function getTitle();

    public function getPlace();

    public function getSalary();

    public function getPhone();

    public function getSorting();

    public function getCreatedAt();

    public function getUpdatedAt();
    
    public function getDescription();
    
    public function setContentFormatter($contentFormatter);
    
    public function getContentFormatter();
}
