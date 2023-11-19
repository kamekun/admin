<?php

namespace BytePlatform\Admin\Livewire\Pages\ThemeOptions;

use BytePlatform\Component;
use BytePlatform\Admin\Facades\SettingForm;
use BytePlatform\Facades\Theme;

class Index extends Component
{
    public $tabActive = 'overview';
    public $tabActiveIndex = 0;
    public function ChangeTab($tab)
    {
        $this->tabActive = $tab;
        $this->tabActiveIndex++;
    }
    public function render()
    {
        page_title('Setting');
        return view('admin::pages.theme-options.index', [
            'formWithTitle' => admin::SiteDataInfo()?->getOptions()?->getFormWithTitles()
        ]);
    }
}