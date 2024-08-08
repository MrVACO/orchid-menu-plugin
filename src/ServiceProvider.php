<?php

declare(strict_types = 1);

namespace MrVaco\Orchid\Menu;

use MrVaco\Orchid\Menu\Classes\MenuEnum;
use Orchid\Icons\IconFinder;
use Orchid\Platform\Dashboard;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;

class ServiceProvider extends OrchidServiceProvider
{
    public function boot(Dashboard $dashboard): void
    {
        $dashboard->registerPermissions(MenuEnum::permissions());
        parent::boot($dashboard);

        $this->router();
        $this->publish();

        $iconFinder = app()->make(IconFinder::class);
        $iconFinder->registerIconDirectory(MenuEnum::author, __DIR__ . '/../resources/icons/');
    }

    public function menu(): array
    {
        return [
            Menu::make(__('Menu'))
                ->icon(MenuEnum::author . '.menu')
                ->permission(MenuEnum::VIEW)
                ->route(MenuEnum::VIEW)
                ->active(MenuEnum::prefix . '*')
                ->sort(100),
        ];
    }

    public function router(): void
    {
        app('router')
            ->domain((string) config('platform.domain'))
            ->group(__DIR__ . '/../routes/web.php');
    }

    protected function publish(): void
    {
        if (!$this->app->runningInConsole())
            return;

        $this->publishes([
            __DIR__ . '/../migrations' => database_path('migrations'),
        ], 'plugin-migrations');
    }
}
