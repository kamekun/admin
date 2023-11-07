<?php

namespace BytePlatform\Admin\Livewire\Extentions;

use BytePlatform\Component;

class Index extends Component
{
    public $ExtentionType;
    public $viewType = 'manager';
    public function switchStore()
    {
        $this->viewType = 'store';
    }
    public function switchManager()
    {
        $this->viewType = 'manager';
    }
    public function switchUpload()
    {

        $this->viewType = 'upload';
    }
    public function render()
    {
        page_title(str($this->ExtentionType)->studly());
        return view('admin::extentions.index', [
            'mode_dev' => byte_mode_dev()
        ]);
    }
}