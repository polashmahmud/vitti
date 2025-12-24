<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\FortifyServiceProvider::class,
    Modules\UserManagement\Providers\UserManagementProvider::class,
    Modules\MenuManagement\Providers\MenuManagementProvider::class,
    Modules\DataTable\Providers\DataTableProvider::class,
];
