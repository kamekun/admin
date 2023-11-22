<?php

use Sokeio\Action;
use Sokeio\Facades\Platform;
use Sokeio\Admin\FieldView;
use Sokeio\Item;
use Sokeio\Admin\Widget;

return [
    'name' => 'Admin',
    'commands' => [],
    'fields' => [
        FieldView::Create('text'),
        FieldView::Create('password'),
        FieldView::Create('images'),
        FieldView::Create('checkbox'),
        FieldView::Create('checkbox-multiple'),
        FieldView::Create('number'),
        FieldView::Create('flatpickr'),
        FieldView::Create('radio'),
        FieldView::Create('toggle'),
        FieldView::Create('subdomain'),
        FieldView::Create('toggle-multiple'),
        FieldView::Create('textarea'),
        FieldView::Create('tinymce'),
        FieldView::Create('select'),
        FieldView::Create('select-multiple'),
        FieldView::Create('tagify'),
        FieldView::Create('readonly'),
        FieldView::Create('choose-modal'),
    ],
    'shortcodes' => [],
    'actions' => [],
    'widgets' => [
        Widget::Create('number-widget')
            ->ActionData(CountModel::class)
            ->Parameters([
                Item::Add('modelCount')->Title('Choose Model')
                    ->Type('select')
                    ->DataOption(function () {
                        return collect(Platform::getModels())->map(function ($value, $key) {
                            return [
                                'value' => $key,
                                'text' => $value
                            ];
                        });
                    }),
                Item::Add('modelLabel')->Title('Label'),
                Item::Add('modelLogo')->Title('Logo(Svg)')->Type('textarea')
            ]),
        Widget::Create('apexcharts-widget')
            ->Parameters([
                Item::Add('actionName')->Title('Choose Action')
                    ->Type('select')
                    ->DataOption(function () {
                        return collect(Action::getActions())->map(function ($value, $key) {
                            return [
                                'value' => $key,
                                'text' => $key
                            ];
                        });
                    }),
                Item::Add('minHeight')->Title('Min Height of chart(px)')->Type('number'),
                Item::Add('chartLogo')->Title('Logo(Svg)')->Type('textarea')
            ])->ActionData(function ($item) {
                return isset($item->getData()['actionName']) ? $item->getData()['actionName'] : null;
            }),
        Widget::Create('form-widget')
            ->Parameters([
                Item::Add('actionName')->Title('Choose Action')
                    ->Type('select')
                    ->DataOption(function () {
                        return collect(Action::getActions())->map(function ($value, $key) {
                            return [
                                'value' => $key,
                                'text' => $key
                            ];
                        });
                    }),
                Item::Add('minHeight')->Title('Min Height of Form(px)')->Type('number'),
                Item::Add('formLogo')->Title('Logo(Svg)')->Type('textarea')
            ])->ActionData(function ($item) {
                return isset($item->getData()['actionName']) ? $item->getData()['actionName'] : null;
            }),
        Widget::Create('table-widget')
            ->Parameters([
                Item::Add('actionName')->Title('Choose Action')
                    ->Type('select')
                    ->DataOption(function () {
                        return collect(Action::getActions())->map(function ($value, $key) {
                            return [
                                'value' => $key,
                                'text' => $key
                            ];
                        });
                    }),
                Item::Add('minHeight')->Title('Min Height of Table(px)')->Type('number'),
                Item::Add('tableLogo')->Title('Logo(Svg)')->Type('textarea')
            ])->ActionData(function ($item) {
                return isset($item->getData()['actionName']) ? $item->getData()['actionName'] : null;
            }),
    ],
];
