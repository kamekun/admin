<?php

namespace BytePlatform\Admin\Livewire\Extentions;

use BytePlatform\Component;

class Upload extends Component
{
    public $ExtentionType;
    public function render()
    {
        return view('admin::extentions.upload');
    }
}
