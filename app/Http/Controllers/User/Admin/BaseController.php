<?php

namespace App\Http\Controllers\User\Admin;

use App\Http\Controllers\User\BaseController as GuestBaseController;

/**
 * Базовый контроллер для всех контроллеров управления
 * пользователями в панели администрирования
 *
 * Должен быть родителем всех контроллеров управления пользователями
 *
 * @package App\Http\Controllers\User\Admin
 */
class BaseController extends GuestBaseController {

    /**
     * BaseController constructor.
     */
    public function __construct () {
        // Инициализация общих моментов для админки.
    }

}
