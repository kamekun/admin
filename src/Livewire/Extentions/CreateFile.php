<?php

namespace Sokeio\Admin\Livewire\Extentions;

use Sokeio\Component;
use Illuminate\Support\Facades\Artisan;

class CreateFile extends Component
{
    public $ExtentionType;
    public $ExtentionId;
    public $InputName;
    public $InputTemplate;
    public function doCreate()
    {
        if ($this->InputName != '') {
            \ob_start();
            Artisan::call('so:make-file', ['name' => [$this->InputName], '-t' => $this->ExtentionType, '-b' => $this->ExtentionId, '-te' => $this->InputTemplate]);
            $output = \ob_get_clean();
            $this->showMessage($output);
            $this->refreshRefComponent();
            $this->closeComponent();
        }
    }
    public function render()
    {
        return view('admin::extentions.create-file', [
            'templates' => [
                ...config('sokeio.stubs.list-files.common'),
                ...config('sokeio.stubs.list-files.' . $this->ExtentionType)
            ],
        ]);
    }
}
