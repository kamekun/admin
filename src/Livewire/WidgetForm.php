<?php

namespace Sokeio\Admin\Livewire;

use Sokeio\Component;
use Sokeio\Admin\Dashboard;
use Sokeio\Admin\Concerns\WithFormData;
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
