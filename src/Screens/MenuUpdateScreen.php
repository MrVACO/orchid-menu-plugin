<?php

declare(strict_types = 1);

namespace MrVaco\Orchid\Menu\Screens;

use MrVaco\Orchid\Menu\Classes\MenuEnum;
use MrVaco\Orchid\Menu\Traits\MenuCUTrait;
use Orchid\Screen\Screen;

class MenuUpdateScreen extends Screen
{
    use MenuCUTrait;

    public function permission(): ?iterable
    {
        return [
            MenuEnum::UPDATE
        ];
    }
}
