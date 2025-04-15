<?php

namespace App\Helpers;

class LayoutHelper
{
    public function isLayoutTopnavEnabled()
    {
        return config('adminlte.layout_topnav') === true;
    }

    public function makeBodyClasses()
    {
        return config('adminlte.classes_body', '');
    }

    public function makeBodyData()
    {
        return config('adminlte.body_data', []);
    }
}
