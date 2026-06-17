<?php
/**
 * Этот файл является частью модуля веб-приложения RosGear.
 * 
 * @link https://rosgear.ru/
 * @copyright Copyright (c) 2015 RosGear
 * @license https://rosgear.ru/license/
 */

namespace Rg\Backend\Task\Controller;

use Ge\Panel\Http\Response;
use Ge\Panel\Controller\BaseController;

/**
 * Контроллер проверки задач.
 * 
 * @author Anton Tivonenko <anton.tivonenko@gmail.com>
 * @package Rg\Backend\Task\Controller
 * @since 1.0
 */
class IndexController extends BaseController
{
    /**
     * Действие "status" проверяет статус пользователя.
     * 
     * @return Response
     */
    public function statusAction(): Response
    {
        /** @var Response $response */
        $response = $this->getResponse();
        // ...
        return $response;
    }
}
