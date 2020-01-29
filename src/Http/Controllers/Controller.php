<?php

namespace SaintSystems\Nova\ResourceGroupMenu\Http\Controllers;

use Laravel\Nova\Nova;
use Illuminate\Http\Request;

class Controller
{
    public function run(Request $request)
    {
        $resourceGroupMenu = collect(Nova::availableTools(request()))->first(function ($tool) {
            return $tool instanceof \SaintSystems\Nova\ResourceGroupMenu\ResourceGroupMenu;
        });

        return $resourceGroupMenu->jsonSerialize();
    }
}
