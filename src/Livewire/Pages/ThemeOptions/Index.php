<?php

namespace Sokeio\Admin\Livewire\Pages\ThemeOptions;

use Sokeio\Component;
use Sokeio\Admin\Facades\SettingForm;
use Sokeio\Facades\Theme;

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
        $theme = Theme::SiteDataInfo();
        if ($theme && method_exists($theme, 'getOptions')) {
            page_title('Setting');
            return view('admin::pages.theme-options.index', [
                'formWithTitle' => $theme?->getOptions()?->getFormWithTitles()
            ]);
        }
        return view('admin::pages.theme-options.index', [
            'formWithTitle' => ''
        ]);
    }
}
