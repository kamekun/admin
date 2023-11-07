<?php

namespace BytePlatform\Admin\Concerns;

use BytePlatform\Admin\Dashboard;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Reactive;

trait WithWidgetData
{
    protected function getListeners()
    {
        return [
            ...parent::getListeners(),
            'refreshData' . $this->widgetId => '__loadData',
        ];
    }
    public function __loadData()
    {
        unset($this->WidgetSetting);
    }
    #[Reactive]
    public $widgetId;

    #[Reactive]
    public $locked = false;
    #[Computed(true)]
    public function WidgetSetting()
    {
        return Dashboard::getWidgetSettingByKey($this->widgetId);
    }
    public function render()
    {
        $WidgetSetting = $this->WidgetSetting;
        return view('admin::widget', [
            'WidgetSetting' => $WidgetSetting,
            'WidgetItem' => Dashboard::getWidgetByKey($WidgetSetting['widgetType'])?->ClearCache()->Data($WidgetSetting)->beforeRender($this)
        ]);
    }
}
