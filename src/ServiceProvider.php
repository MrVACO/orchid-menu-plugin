<?php

declare(strict_types = 1);

namespace MrVaco\Orchid\Menu;

use Orchid\Platform\Dashboard;
use Orchid\Platform\OrchidServiceProvider;

class ServiceProvider extends OrchidServiceProvider
{
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);
    }
}
