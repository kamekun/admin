<?php

namespace Sokeio\Admin\Livewire\Pages\Profile;

use Sokeio\Component;

class Index extends Component
{
    public function mount()
    {
        page_title('Profile');
    }
    public function render()
    {
        return view('admin::pages.profile.index');
    }
}
