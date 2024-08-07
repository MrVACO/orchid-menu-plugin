<?php

declare(strict_types = 1);

namespace MrVaco\Orchid\Menu\Screens;

use MrVaco\Orchid\Menu\Classes\MenuEnum;
use MrVaco\Orchid\Menu\Models\Menu;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;

class MenuListScreen extends Screen
{
    public function query(): iterable
    {
        return [
            'menu' => Menu::query()
                ->orderBy('parent_id')
                ->get()
        ];
    }

    public function name(): ?string
    {
        return 'Menu';
    }

    public function commandBar(): array
    {
        return [
            Link::make(__('Add'))
                ->icon('bs.plus')
                ->type(Color::SUCCESS)
                ->canSee(auth()->user()->hasAccess(MenuEnum::CREATE))
                ->route(MenuEnum::CREATE),
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::table('menu', [
                TD::make('name', __('Name'))
                    ->cantHide()
                    ->render(function (Menu $menu) {
                        if (auth()->user()->hasAccess(MenuEnum::UPDATE))
                        {
                            return Link::make($menu->name)->route(MenuEnum::UPDATE, $menu->id);
                        }

                        return $menu->name;
                    }),

                TD::make('parent', __('Parent'))
                    ->render(fn (Menu $menu) => $menu->parent?->name ?? null),

                TD::make('slug', __('Slug')),

                TD::make('target', __('Link target')),

                TD::make('created_at', __('Created'))
                    ->usingComponent(DateTimeSplit::class)
                    ->alignCenter()
                    ->defaultHidden(),

                TD::make('updated_at', __('Last edit'))
                    ->usingComponent(DateTimeSplit::class)
                    ->alignCenter(),
            ])
        ];
    }
}
