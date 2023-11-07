<?php

namespace BytePlatform\Admin\Concerns;

trait WithFormPageData
{
    use WithFormData;
    public function getView()
    {
        return 'admin::forms.page';
    }
    public function render()
    {
        page_title($this->getItemManager()?->getTitle(),true);
        return view('admin::forms.page', [
            'itemManager' => $this->getItemManager()
        ]);
    }
}
