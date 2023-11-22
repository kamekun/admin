<?php

namespace Sokeio\Admin\Livewire\Extentions;

use Sokeio\Component;

class Upload extends Component
{
    public $ExtentionType;
    public function render()
    {
        return view('admin::extentions.upload');
    }
}
