<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Domstor\TemplateBundle\Model;
use Domstor\TemplateBundle\Model\TitleProviderInterface;
use Domstor_Domstor;

/**
 * Description of TitleProvider
 *
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */
class TitleProvider implements TitleProviderInterface
{
    /**
     *
     * @var Domstor_Domstor
     */
    private $domstor;
        
    public function __construct(Domstor_Domstor $domstor) {
        $this->domstor = $domstor;
    }

    private $objects = array(
        'flat' => 'Квартиры',
        'house' => 'Дома и коттеджи',
        'land' => 'Земля и дачи',
        'garage' => 'Гаражи и парковки',
        'office' => 'Офисная',
        'trade' => 'Торговая',
        'product' => 'Производственная',
        'storehouse' => 'Складская',
        'landcom' => 'Земля',
        'other' => 'Прочее',
        'complex' => 'Имущественные',
    );
    
    private $objectsHtml = array(
        'flat' => 'Квартиры',
        'house' => 'Дома<br>Коттеджи',
        'land' => 'Дачи<br>Земля',
        'garage' => 'Гаражи<br>Парковки',
        'office' => 'Офисная',
        'trade' => 'Торговая',
        'product' => 'Производственная',
        'storehouse' => 'Складская',
        'landcom' => 'Земля',
        'other' => 'Прочее',
        'complex' => 'Имущественные',
    );
    
    private $actions = array(
        'sale' => 'Продают',
        'rent' => 'Сдают',
        'purchase' => 'Купят',
        'rentuse' => 'Снимут',
        'exchange' => 'Обмен',
        'new' => 'Новостройки',
    );
    
    public function getType($object)
    {
        if (!isset($this->objects[$object])) {
            throw new \Exception('Unsupported type ' . $object);
        }
        
        return $this->objects[$object];
    }
    
    public function getTypeHtml($object)
    {
        if (!isset($this->objectsHtml[$object])) {
            throw new \Exception('Unsupported type ' . $object);
        }
        
        return $this->objectsHtml[$object];
    }    
    
    public function getAction($action)
    {
        if (!isset($this->actions[$action])) {
            throw new \Exception('Unsupported action ' . $action);
        }
        
        return $this->actions[$action];
    }
    
    public function getListTitle($object, $action) {
        $locName = $this->domstor->getLocationName('pr');
        $title = 'Недвижимость в %s';
        switch ($object) {
            case 'flat':
                switch ($action) {
                    case 'sale':
                        $title = 'Продажа квартир в %s';
                        break;
                    case 'rent':
                        $title = 'Аренда квартир в %s';
                        break;
                    case 'purchase':
                        $title = 'Покупка квартир в %s';
                        break;
                    case 'rentuse':
                        $title = 'Заявки на аренду квартир в %s';
                        break;
                    case 'exchange':
                        $title = 'Обмен квартир в %s';
                        break;
                    case 'new':
                        $title = 'Новостройки в %s';
                        break;
                }
                break;
            case 'house':
                switch ($action) {
                    case 'sale':
                        $title = 'Продажа домов в %s';
                        break;
                    case 'rent':
                        $title = 'Аренда домов в %s';
                        break;
                    case 'purchase':
                        $title = 'Покупка домов в %s';
                        break;
                    case 'rentuse':
                        $title = 'Заявки на аренду домов в %s';
                        break;
                    case 'exchange':
                        $title = 'Обмен домов в %s';
                        break;
                }
                break;
            case 'garage':
                switch ($action) {
                    case 'sale':
                        $title = 'Продажа гаражей в %s';
                        break;
                    case 'rent':
                        $title = 'Аренда гаражей в %s';
                        break;
                    case 'purchase':
                        $title = 'Покупка гаражей в %s';
                        break;
                    case 'rentuse':
                        $title = 'Заявки на аренду гаражей в %s';
                        break;
                }
                break;
            case 'land':
                switch ($action) {
                    case 'sale':
                        $title = 'Продажа земли и дач в %s';
                        break;
                    case 'rent':
                        $title = 'Аренда земли и дач в %s';
                        break;
                    case 'purchase':
                        $title = 'Покупка земли и дач в %s';
                        break;
                    case 'rentuse':
                        $title = 'Заявки на аренду земли и дач в %s';
                        break;
                }
                break;
            case 'trade':
                switch ($action) {
                    case 'sale':
                        $title = 'Продажа торговых помещений в %s';
                        break;
                    case 'rent':
                        $title = 'Аренда торговых помещений в %s';
                        break;
                    case 'purchase':
                        $title = 'Покупка торговых помещений в %s';
                        break;
                    case 'rentuse':
                        $title = 'Заявки на аренду торговых помещений в %s';
                        break;
                }
                break;
            case 'office':
                switch ($action) {
                    case 'sale':
                        $title = 'Продажа офисных помещений в %s';
                        break;
                    case 'rent':
                        $title = 'Аренда офисных помещений в %s';
                        break;
                    case 'purchase':
                        $title = 'Покупка офисных помещений в %s';
                        break;
                    case 'rentuse':
                        $title = 'Заявки на аренду офисных помещений в %s';
                        break;
                }
                break;
            case 'product':
                switch ($action) {
                    case 'sale':
                        $title = 'Продажа производственных помещений в %s';
                        break;
                    case 'rent':
                        $title = 'Аренда производственных помещений в %s';
                        break;
                    case 'purchase':
                        $title = 'Покупка производственных помещений в %s';
                        break;
                    case 'rentuse':
                        $title = 'Заявки на аренду производственных помещений в %s';
                        break;
                }
                break;
            case 'storehouse':
                switch ($action) {
                    case 'sale':
                        $title = 'Продажа складских помещений в %s';
                        break;
                    case 'rent':
                        $title = 'Аренда складских помещений в %s';
                        break;
                    case 'purchase':
                        $title = 'Покупка складских помещений в %s';
                        break;
                    case 'rentuse':
                        $title = 'Заявки на аренду складских помещений в %s';
                        break;
                }
                break;
            case 'landcom':
                switch ($action) {
                    case 'sale':
                        $title = 'Продажа коммерческой земли в %s';
                        break;
                    case 'rent':
                        $title = 'Аренда коммерческой земли в %s';
                        break;
                    case 'purchase':
                        $title = 'Покупка коммерческой земли в %s';
                        break;
                    case 'rentuse':
                        $title = 'Заявки на аренду коммерческой земли в %s';
                        break;
                }
                break;
            case 'complex':
                switch ($action) {
                    case 'sale':
                        $title = 'Продажа имущественных комплексов в %s';
                        break;
                    case 'rent':
                        $title = 'Аренда имущественных комплексов в %s';
                        break;
                }
                break;
            case 'other':
                switch ($action) {
                    case 'sale':
                        $title = 'Продажа нежилых помещений в %s';
                        break;
                    case 'rent':
                        $title = 'Аренда нежилых помещений в %s';
                        break;
                    case 'purchase':
                        $title = 'Покупка нежилых помещений в %s';
                        break;
                    case 'rentuse':
                        $title = 'Заявки на аренду нежилых помещений в %s';
                        break;
                }
                break;
        }
        
        return sprintf($title, $locName);
    }
}
