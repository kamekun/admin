<?php

namespace BytePlatform\Admin\Livewire;

use BytePlatform\Component;
use BytePlatform\Admin\Dashboard;
use BytePlatform\Admin\Concerns\WithFormData;
use Livewire\Attributes\Reactive;

class WidgetForm extends Component
{
    #[Reactive]
    public $widgetId;
    #[Reactive]
    public $locked = false;

    use WithFormData;
    protected function getListeners()
    {
        return [
            ...parent::getListeners(),
            'refreshData' . $this->widgetId => '__loadData',
        ];
    }
    protected function ItemManager()
    {
        if (!$this->widgetId) {
            return;
        }
        $WidgetSetting = Dashboard::getWidgetSettingByKey($this->widgetId);
        if ($WidgetSetting && isset($WidgetSetting['widgetType'])) {
            $dataWidget = Dashboard::getWidgetByKey($WidgetSetting['widgetType'])?->ClearCache()->Data($WidgetSetting)->beforeRender($this)->getWidgetData();
            if ($dataWidget && isset($dataWidget['manager'])) {
                return $dataWidget['manager'];
            }
        }
        return null;
    }
}
