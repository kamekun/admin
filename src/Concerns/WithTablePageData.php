<?php

namespace BytePlatform\Admin\Concerns;

trait WithTablePageData
{
    use WithTableData;
    protected function cardBodyClass()
    {
        return "p-2";
    }

    public function render()
    {
        page_title($this->getItemManager()?->getTitle(), true);
        return view('admin::tables.page', [
            'itemManager' => $this->getItemManager(),
            'dataItems' => $this->getDataItems(),
            'cardBodyClass' => $this->cardBodyClass()
        ]);
    }
}
