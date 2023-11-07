<?php

namespace BytePlatform\Admin\Livewire;

use BytePlatform\Component;
use BytePlatform\Admin\Dashboard as ByteAdminDashboard;
use Livewire\Attributes\Computed;

class Dashboard extends Component
{
    public $widgets = [];
    public $widgetKey = 0;
    protected function getListeners()
    {
        return [
            ...parent::getListeners(),
            'DashboardRefreshData'  => '__loadData',
        ];
    }
    #[Computed]
    public function locked()
    {
        return !checkPermission('admin.widget-setting');
    }
    public function mount()
    {
        $this->__loadData();
    }
    public function __loadData()
    {
        $this->widgets = ByteAdminDashboard::GetWidgetIdActives();
        $this->widgetKey++;
    }

    public function render()
    {
        page_title('Dashboard', true);
        return view('admin::dashboard', [
            'locked' => $this->locked
        ]);
    }
}
