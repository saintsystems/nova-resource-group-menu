<?php

namespace SaintSystems\Nova\ResourceGroupMenu;

use Illuminate\Http\Request;

trait DisplaysInResourceMenu
{
    /**
     * Get meta information about this resource for client side comsumption.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public static function additionalInformation(Request $request)
    {
        return array_merge(parent::additionalInformation($request), [
            'group' => static::$group,
            'subGroup' => static::$subGroup ?? null,
        ]);
    }
}
