<?php

namespace BytePlatform\Admin\Livewire;

use BytePlatform\Component;
use BytePlatform\Admin\ItemManager;
use BytePlatform\Admin\Concerns\WithTableData;

class Table extends Component
{
    use WithTableData;
    public ItemManager $manager;
    protected function ItemManager()
    {
        return $this->manager;
    }
}
