<?php

namespace Sokeio\Admin\Livewire\Pages\Profile;

use Sokeio\Component;
use Sokeio\Item;
use Sokeio\ItemForm;
use Sokeio\Admin\ItemManager;
use Sokeio\Admin\Models\User;
use Sokeio\Admin\Concerns\WithItemManager;

class Edit extends Component
{
    use WithItemManager;
    protected function ItemManager()
    {
        return ItemManager::Form()->Layout([
            ['key' => 'column1', 'class' => '', 'column' => Item::Col4],
            ['key' => 'column2', 'class' => '', 'column' => Item::Col8]
        ])
            ->LayoutDefault('column2')->Model(User::class)->Item([
                Item::Add('avatar')->Title('Account Avatar')->Column(Item::Col12)->Layout('column1')->Type('images'),
                Item::Add('email')->Title('Email')->Type('readonly')->Column(Item::Col12),
                Item::Add('name')->Title('Account Name')->Column(Item::Col12)->Required(),
                Item::Add('phone_number')->Title('Phone Number')->Column(Item::Col12),
                Item::Add('info')->Title('Profile Info')->Type('textarea')->Column(Item::Col12),
            ]);
    }
    public ItemForm $form;
    public function mount()
    {
        $this->refreshUser();
    }
    public function refreshUser()
    {
        $this->form->DataToForm(auth()->user());
    }
    public function saveUser()
    {
        $this->form->setDataId(auth()->user()->id);
        $this->form->DataFromForm();
        return redirect(route('admin.profile'));
    }
    public function render()
    {
        page_title('Profile Edit');
        return view('admin::pages.profile.edit', [
            'itemManager' => $this->getItemManager()
        ]);
    }
}
