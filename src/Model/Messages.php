<?php
/**
 * Этот файл является частью модуля веб-приложения RosGear.
 * 
 * @link https://rosgear.ru/
 * @copyright Copyright (c) 2015 RosGear
 * @license https://rosgear.ru/license/
 */

namespace Rg\Backend\Task\Model;

use Ge;
use Ge\Helper\Str;
use Ge\Data\Model\DataModel;

/**
 * Класс модели данных сообщений.
 * 
 * @author Anton Tivonenko <anton.tivonenko@gmail.com>
 * @package Rg\Backend\Task\Model
 * @since 1.0
 */
class Messages extends DataModel
{
    /**
     * @var array
     */
    protected array $defItemOptions = [
        'element' => '', 'icon' => '', 'messages' => '', 'widgetRead' => '', 'widgetMessages' => ''
    ];

    /**
     * @param array $items
     * 
     * @return void
     */
    protected function addMessagesToItems(array &$items): void
    {
        $userId = Ge::$app->user->getId();
        $data = array();
        foreach ($items as $id => $item) {
            $sql = 'SELECT * FROM `{{panel_message}}` WHERE `read`<>1 AND `type_id`=:typeId AND `user_id`=:userId ORDER BY `date` ASC LIMIT :limit';
            $cmd = $this->adapter->createCommand($sql);
            $cmd->bindValues(array(
                ':typeId' => $id,
                ':userId' => $userId,
                ':limit'  => $item['options']['messages']
            ))->query();
            while ($message = $cmd->fetch()) {
                $items[$id]['messages'][] = $message;
            }
        }
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        $sql = 'SELECT * FROM `{{panel_message_type}}` ORDER  BY `index` ASC';

        $this->adapter->connect();
        $cmd = $this->adapter->createCommand($sql)->query();
        $items = array();
        while ($item = $cmd->fetch()) {
            $options = array();
            if ($item['options']) {
                $options = json_decode($item['options'], true);
                $options = array_merge($this->defItemOptions, $options);
            }
            $item['messages'] = array();
            $item['options'] = $options;
            $items[$item['id']] = $item;

        }

        $this->addMessagesToItems($items);
        return $items;
    }

    /**
     * @return array
     */
    public function getItemsArray(): array
    {
        $items = $this->getItems();
        $result = [];
        foreach ($items as $item) {
            $menuItems = [];
            $length = empty($item['options']['length']) ? 50 : (int) $item['options']['length'];
            foreach ($item['messages'] as $message) {
                $menuItems[] = [
                    'text'    => Str::ellipsis($message['text'], 0, $length), 
                    'handler' => 'loadWidget', 
                    'iconCls' => 'fa fa-color-menu fa-cog'
                ];
            }
            $result[] = [
                'id'     => $item['options']['element'],
                'faIcon' => $item['options']['icon'],
                'count'  => sizeof($menuItems),
                'menu'   => [
                    'mouseLeaveDelay' => 0,
                    'cls'             => 'g-tray-menu',
                    'items'           => $menuItems
                ]
            ];
        }
        return $result;
    }
}
