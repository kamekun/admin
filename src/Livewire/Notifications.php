<?php

namespace Sokeio\Admin\Livewire;

use Sokeio\Component;
use Sokeio\Models\Notification;
use Livewire\Attributes\On;

class Notifications extends Component
{
    public $title = 'Last updates';
    public $notifications = [];
    public $showNewNotification = false;

    #[On('echo:notifications,NotificationAdd')]
    public function notifyNew()
    {
        $this->showNewNotification = true;
    }
    public function mount()
    {
        $this->loadNoiti();
    }
    public function loadNoiti()
    {
        $this->notifications = Notification::latest()->limit(10)->get()->toArray();
    }
    public function render()
    {
        return view_scope('admin::notifications');
    }
}
