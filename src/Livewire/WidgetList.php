<?php

namespace Sokeio\Admin\Livewire;

use Sokeio\Component;
use Livewire\Attributes\Reactive;
use Sokeio\Admin\Dashboard as ByteAdminDashboard;

class WidgetList extends Component
{
    #[Reactive]
    public $widgets;
    #[Reactive]
    public $locked = false;
    public function updateWidgetOrder($data)
    {
        $data =  collect($data)->map(function ($item) {
            return $item['value'];
        })->toArray();
        ByteAdminDashboard::Update($data);
        $this->skipRender();
        $this->dispatch('DashboardRefreshData');
    }
    public function render()
    {
        return view('admin::widget-list');
    }
}
