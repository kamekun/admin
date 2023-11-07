<?php

namespace BytePlatform\Admin\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * 
 * @method static void Register($callback, $form = 'overview')
 * @method static mix getFormByKey($key= 'overview')
 * @method static array getForms()
 * @method static array getFormWithTitles()
 * 
 * 
 *
 * @see \BytePlatform\Admin\Facades\SettingForm
 * 
 */
/*
        use BytePlatform\Admin\Facades\SettingForm;

        SettingForm::Register(function (\BytePlatform\Admin\ItemManager $item) {
            return $item;
        });

 * */
class SettingForm extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \BytePlatform\Admin\FormCollection::class;
    }
}
