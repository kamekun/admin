<?php

namespace BytePlatform\Admin\Livewire;

use BytePlatform\Component;
use BytePlatform\Admin\Concerns\WithFormData;
use BytePlatform\Item;
use BytePlatform\Admin\ItemManager;

class SeoBox extends Component
{
    use WithFormData;
    protected function ItemManager()
    {
        if (!class_exists('\\BytePlatform\Admin\\Seo\\Models\\SEO')) return null;
        return ItemManager::Form()->Model(\BytePlatform\Admin\Seo\Models\SEO::class)->Item([
            Item::Add('title')->Column(Item::Col12)->Title('Title'),
            Item::Add('description')->Column(Item::Col12)->Title('Description')->Type('textarea'),
            Item::Add('image')->Column(Item::Col12)->Title('Image')->Type('images'),
            Item::Add('author')->Column(Item::Col12)->Title('Author'),
            Item::Add('robots')->Column(Item::Col12)->Title('Robots')->Type('textarea'),
            Item::Add('canonical_url')->Column(Item::Col12)->Title('Canonical Url'),
        ])->FormDoSave(function ($params, $component, $manager) {
            $component->form->DataFromForm();
            $component->showMessage($manager->getMessage());
            // $component->closeComponent();
            $component->refreshRefComponent();
        })->Message(function(){
            return "seo update successfully";
        });
    }
}
