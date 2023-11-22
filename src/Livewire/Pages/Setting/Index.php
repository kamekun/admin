<?php

namespace Sokeio\Admin\Livewire\Pages\Setting;

use Sokeio\Component;
use Sokeio\Admin\Facades\SettingForm;

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
        return view('admin::pages.setting.index', [
            'formWithTitle' => SettingForm::getFormWithTitles()
        ]);
    }
}
