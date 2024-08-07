<?php

declare(strict_types = 1);

use MrVaco\Orchid\Menu\Classes\MenuEnum;
use MrVaco\Orchid\Menu\Screens\MenuCreateScreen;
use MrVaco\Orchid\Menu\Screens\MenuListScreen;
use MrVaco\Orchid\Menu\Screens\MenuUpdateScreen;
use Tabuna\Breadcrumbs\Trail;

app('router')
    ->middleware(config('platform.middleware.private'))
    ->prefix('menu')
    ->group(static function () {
        app('router')
            ->screen('', MenuListScreen::class)
            ->name(MenuEnum::VIEW)
            ->breadcrumbs(fn (Trail $trail) => $trail
                ->parent('platform.index')
                ->push(__('Menu'))
            );

        app('router')
            ->screen('create', MenuCreateScreen::class)
            ->name(MenuEnum::CREATE)
            ->breadcrumbs(fn (Trail $trail) => $trail
                ->parent('platform.index')
                ->push(__('Menu'), route(MenuEnum::VIEW))
                ->push(__('Create'))
            );

        app('router')
            ->screen('{menu}/update', MenuUpdateScreen::class)
            ->name(MenuEnum::UPDATE)
            ->breadcrumbs(fn (Trail $trail) => $trail
                ->parent('platform.index')
                ->push(__('Menu'), route(MenuEnum::VIEW))
                ->push(__('Update'))
            );
    });
