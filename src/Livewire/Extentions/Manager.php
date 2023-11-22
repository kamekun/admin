<?php

namespace Sokeio\Admin\Livewire\Extentions;

use Sokeio\Component;
use Sokeio\Concerns\WithPagination;

class Manager extends Component
{
    use WithPagination;
    public $ExtentionType;
    public $pageSize = 10;
    public function ItemChangeStatus($itemId, $status)
    {
        platform_by($this->ExtentionType)->find($itemId)->status = $status;
    }
    public function render()
    {
        return view('admin::extentions.manager', [
            'dataItems' => collect(platform_by($this->ExtentionType)->getDataAll())->paginate($this->pageSize),
            'pageSizeList' => [5, 10, 20, 50]
        ]);
    }
}
