<?php

declare(strict_types = 1);

namespace MrVaco\Orchid\Menu\Classes;

use Orchid\Platform\ItemPermission;

enum MenuEnum
{
    const author = 'mr_vaco';
    const prefix = self::author . '.menu';

    const VIEW = self::prefix . '.view';
    const CREATE = self::prefix . '.create';
    const UPDATE = self::prefix . '.update';
    const DELETE = self::prefix . '.delete';

    static public function permissions()
    {
        return ItemPermission::group('Menu')
            ->addPermission(self::VIEW, __('View'))
            ->addPermission(self::CREATE, __('Create'))
            ->addPermission(self::UPDATE, __('Update'))
            ->addPermission(self::DELETE, __('Delete'));
    }
}
