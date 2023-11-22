<?php

namespace Sokeio\Admin\Livewire;

use Sokeio\Component;
use Sokeio\Admin\Concerns\WithFormData;

class FormPage extends Component
{
    use WithFormData;
    public $manager;
    public $formCustom;
    protected function ItemManager()
    {
        if ($this->formCustom) {
            return app($this->manager)->getFormCustom($this->formCustom);
        }
        return app($this->manager)->FormPage();
    }
    protected function getView()
    {
        return 'admin::forms.page';
    }
}
