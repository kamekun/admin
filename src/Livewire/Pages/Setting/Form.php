<?php

namespace Sokeio\Admin\Livewire\Pages\Setting;

use Sokeio\Component;
use Sokeio\Admin\Facades\SettingForm;
use Sokeio\Facades\Theme;
use Sokeio\ItemForm;
use Sokeio\Admin\Concerns\WithItemManager;

class Form extends Component
{
    use WithItemManager;
    protected function ItemManager()
    {
        if ($this->tabActive)
            return SettingForm::getFormByKey($this->tabActive);
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
        if ($manager = $this->getItemManager()) {
            foreach ($manager->getItems() as $item) {
                $arr[$item->getField()] = setting($item->getField());
            }
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
        return view('admin::pages.setting.form', [
            'itemManager' => $this->getItemManager()
        ]);
    }
}
