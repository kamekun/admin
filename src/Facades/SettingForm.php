<?php

namespace Sokeio\Admin\Facades;

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
 * @see \Sokeio\Admin\Facades\SettingForm
 * 
 */
/*
        use Sokeio\Admin\Facades\SettingForm;

        SettingForm::Register(function (\Sokeio\Admin\ItemManager $item) {
            return $item;
        });

 * */
class SettingForm extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Sokeio\Admin\FormCollection::class;
    }
}
