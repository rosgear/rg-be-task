<?php
/**
 * Этот файл является частью модуля веб-приложения RosGear.
 * 
 * Файл конфигурации установки модуля.
 * 
 * @link https://rosgear.ru/
 * @copyright Copyright (c) 2015 RosGear
 * @license https://rosgear.ru/license/
 */

return [
    'use'         => BACKEND,
    'id'          => 'rg.be.task',
    'name'        => 'System tasks',
    'description' => 'Executing tasks on the client initiated by the server',
    'namespace'   => 'Rg\Backend\Task',
    'path'        => '/rg/rg.be.task',
    'route'       => 'task',
    'routes'      => [
        [
            'type'    => 'crudSegments',
            'options' => [
                'module'      => 'rg.be.task',
                'route'       => 'task',
                'prefix'      => BACKEND,
                'constraints' => ['id'],
                'defaults'    => [
                    'controller' => 'index'
                ]
            ]
        ]
    ],
    'locales'     => ['ru_RU', 'en_GB'],
    'permissions' => ['info'],
    'events'      => [],
    'required'    => [
        ['php', 'version' => '8.2'],
        ['app', 'code' => 'RG Workspace'],
        ['app', 'code' => 'RG CMS'],
        ['app', 'code' => 'RG CRM'],
    ]
];
