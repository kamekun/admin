<?php

namespace Sokeio\Admin\Livewire;

use Sokeio\Component;
use Sokeio\Admin\Concerns\WithFormData;
use Sokeio\Item;
use Sokeio\Admin\ItemManager;

class SeoBox extends Component
{
    use WithFormData;
    protected function ItemManager()
    {
        if (!class_exists('\\Sokeio\\Seo\\Models\\SEO')) return null;
        return ItemManager::Form()->Model(\Sokeio\Seo\Models\SEO::class)->Item([
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
