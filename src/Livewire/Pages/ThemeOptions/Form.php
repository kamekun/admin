<?php

namespace BytePlatform\Admin\Livewire\Pages\ThemeOptions;

use BytePlatform\Component;
use BytePlatform\Facades\Theme;
use BytePlatform\ItemForm;
use BytePlatform\Admin\Concerns\WithItemManager;

class Form extends Component
{
    use WithItemManager;
    protected function ItemManager()
    {
        if ($this->tabActive && ($theme = admin::SiteDataInfo()))
            return $theme->getOptions()->getFormByKey($this->tabActive);
        return null;
    }
    public ItemForm $form;

    public $tabActive;

    public function mount()
    {
        $this->BindData();
    }
    public function BindData()
    {
        $arr = [];
        foreach ($this->getItemManager()->getItems() as $item) {
            $arr[$item->getField()] = setting($item->getField());
        }
        $this->form->DataToForm($arr);
    }
    public function saveSetting()
    {
        $this->form->CheckValidate();
        foreach ($this->form->toArray() as $key => $value) {
            if ($key == 'page_site_theme') {
                admin::find($value)?->Active();
            } else {
                set_setting($key, $value);
            }
        };
        $this->showMessage('Update setting success!');
    }

    public function render()
    {
        return view('admin::pages.theme-options.form', [
            'itemManager' => $this->getItemManager()
        ]);
    }
}
