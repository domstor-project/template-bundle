<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Domstor\TemplateBundle\Model;

use Domstor\TemplateBundle\Model\TitleProviderInterface;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Description of TitleProvider
 *
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */
class TitleProvider implements TitleProviderInterface
{
    private $objects;
    
    private $objectsHtml;
    
    private $actions;
    
    private $translator;

    public function __construct(array $objects, array $objectsHtml, array $actions, TranslatorInterface $translator)
    {
        $this->objects = $objects;
        $this->objectsHtml = $objectsHtml;
        $this->actions = $actions;
        $this->translator = $translator;
    }

    public function getType($object)
    {
        if (!isset($this->objects[$object]))
        {
            throw new \Exception('Unsupported type ' . $object);
        }

        return $this->objects[$object];
    }

    public function getTypeHtml($object)
    {
        if (!isset($this->objectsHtml[$object]))
        {
            throw new \Exception('Unsupported type ' . $object);
        }

        return $this->objectsHtml[$object];
    }

    public function getAction($action)
    {
        if (!isset($this->actions[$action]))
        {
            throw new \Exception('Unsupported action ' . $action);
        }

        return $this->actions[$action];
    }

    public function getListTitle($object, $action, $locName)
    {
        $domain = 'TitleProvider';
        //$title = 'Недвижимость в %s';
        $id = $object . '.' . $action . '.title';
        return sprintf($this->translator->trans($id, [], $domain), $locName);
    }

}
