<?php

declare(strict_types = 1);

namespace MrVaco\Orchid\Menu\Controllers;

use MrVaco\Orchid\Menu\Models\Menu;
use MrVaco\Orchid\Menu\Resources\MenuResource;

class MenuController
{
    public function list(string $slug = 'topmenu')
    {
        $data = Menu::query()
            ->where('slug', $slug)
            ->firstOrFail();

        return MenuResource::make($data);
    }
}
