<?php

namespace Sokeio\Admin\Livewire;

use Sokeio\Component;
use Sokeio\Admin\ItemManager;
use Sokeio\Admin\Concerns\WithTableData;

class Table extends Component
{
    use WithTableData;
    public ItemManager $manager;
    protected function ItemManager()
    {
        return $this->manager;
    }
}
