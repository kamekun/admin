<?php

//code php

use BytePlatform\Admin\BaseManager;
use BytePlatform\Admin\Facades\Menu;
use BytePlatform\Admin\FieldView;
use BytePlatform\Item;

if (!function_exists('menu_render')) {
    function menu_render($_position = '')
    {
        return Menu::render($_position);
    }
}
if (!function_exists('field_render')) {
    function field_render(Item $item, $itemForm = null, $dataId = null)
    {
        return FieldView::Render($item, $itemForm, $dataId);
    }
}
if (!function_exists('form_render')) {
    function form_render(BaseManager $itemManager,  $itemForm = null, $dataId = null)
    {
        return view('admin::forms.render', [
            'manager' => $itemManager,
            'form' => $itemForm,
            'dataId' => $dataId
        ])->render();
    }
}

if (!function_exists('table_render')) {
    function table_render(BaseManager $itemManager, $dataItems = null, $dataFilters = null, $dataSorts = null, $formTable = null, $selectIds = null)
    {
        return view('admin::tables.render', [
            'manager' => $itemManager,
            'items' => $dataItems,
            'filters' => $dataFilters,
            'sorts' => $dataSorts,
            'formTable' => $formTable,
            'selectIds' => $selectIds,
        ])->render();
    }
}
