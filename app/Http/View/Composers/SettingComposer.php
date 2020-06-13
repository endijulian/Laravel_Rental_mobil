<?php

namespace App\Http\View\Composers;

use App\Repositories\UserRepository;
use Illuminate\View\View;
use App\Setting;

class SettingComposer
{
    public function compose(View $view)
    {
        $view->with('site_setting', Setting::first());
    }
}
