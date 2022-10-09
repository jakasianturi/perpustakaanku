<?php

namespace App\View\Composers;

use Illuminate\View\View;
use Services\SettingService;

class SettingComposer
{
    protected $setting;

    public function __construct(SettingService $setting)
    {
        $this->setting = $setting;
    }

    public function compose(View $view)
    {
        $setting = $this->setting->getSetting();
        
        $view->with(compact('setting'));
    }
}