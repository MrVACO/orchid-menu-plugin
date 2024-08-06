<?php

declare(strict_types = 1);

namespace MrVaco\Orchid\Menu\Classes;

enum MenuEnum
{
    const prefix = 'mr_vaco.menu';

    const VIEW = self::prefix . '.view';
    const CREATE = self::prefix . '.create';
    const UPDATE = self::prefix . '.update';
    const DELETE = self::prefix . '.delete';
}
