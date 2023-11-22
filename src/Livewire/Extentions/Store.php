<?php

namespace Sokeio\Admin\Livewire\Extentions;

use Sokeio\Component;

class Store extends Component
{
    public $ExtentionType;
    public function render()
    {
        return view('admin::extentions.store');
    }
}
