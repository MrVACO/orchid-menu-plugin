<?php

declare(strict_types = 1);

namespace MrVaco\Orchid\Menu\Traits;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use MrVaco\Orchid\Menu\Classes\MenuEnum;
use MrVaco\Orchid\Menu\Models\Menu;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

trait MenuCUTrait
{
    public $menu;

    public function query(Menu $menu): iterable
    {
        return [
            'menu' => $menu,
        ];
    }

    public function name(): ?string
    {
        return $this->menu->exists
            ? __('Update :name', ['name' => $this->menu->name])
            : __('Create menu item');
    }

    public function commandBar(): iterable
    {
        return [
            Button::make(__('Save'))
                ->icon('bs.check-circle-fill')
                ->type(Color::SUCCESS)
                ->canSee(auth()->user()->hasAccess(MenuEnum::CREATE))
                ->method('save'),

            Button::make(__('Remove'))
                ->icon('bs.trash3')
                ->type(Color::DANGER)
                ->canSee($this->menu->exists && auth()->user()->hasAccess(MenuEnum::DELETE))
                ->confirm(__(MenuEnum::prefix . '::plugin_menu.confirm_delete'))
                ->method('remove'),

            Link::make(__('Cancel'))
                ->icon('bs.x')
                ->type(Color::LINK)
                ->route(MenuEnum::VIEW),
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::rows([
                Group::make([
                    Input::make('menu.name')
                        ->title(__('Name'))
                        ->type('text')
                        ->max(255)
                        ->required(),

                    Input::make('menu.slug')
                        ->title(__('Slug'))
                        ->type('text')
                        ->max(255)
                        ->required(),
                ]),

                Group::make([
                    Select::make('menu.parent_id')
                        ->title(__('Parent'))
                        ->empty(__('do_not_specify'))
                        ->fromQuery(Menu::query(), 'name'),

                    Select::make('menu.target')
                        ->options([
                            '_self' => __('Current page'),
                            '_blank' => __('New page'),
                            '_parent' => __('Parent'),
                            '_top' => __('Current page'),
                        ])
                        ->title(__('Link target')),
                ]),
            ])
        ];
    }

    public function save(Menu $menu, Request $request): RedirectResponse
    {
        $request->validate([
            'menu.name' => [
                'required',
            ],
        ]);

        $menu->fill($request->collect('menu')->toArray())
            ->save();

        Toast::success(__('Saved'));

        return redirect()->route(MenuEnum::VIEW);
    }
}
