<?php

namespace Sokeio\Admin;

use Sokeio\Admin\Facades\Menu;
use Sokeio\Admin\Facades\SettingForm;
use Sokeio\Admin\Menu\MenuBuilder;
use Illuminate\Support\ServiceProvider;
use Sokeio\Laravel\ServicePackage;
use Sokeio\Concerns\WithServiceProvider;
use Sokeio\Facades\Platform;
use Sokeio\Facades\Theme;
use Sokeio\Item;
use Illuminate\Support\Facades\Request;

class AdminServiceProvider extends ServiceProvider
{
    use WithServiceProvider;

    public function configurePackage(ServicePackage $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         */
        $package
            ->name('admin')
            ->hasConfigFile()
            ->hasViews()
            ->hasHelpers()
            ->hasAssets()
            ->hasTranslations()
            ->runsMigrations();
    }
    public function extending()
    {
    }
    public function packageRegistered()
    {
        Item::macro('ConvertToButton', function () {
            return Button::Create($this->getTitle())->Manager($this->getManager())->Data($this->getData());
        });
        $this->extending();
        if ($fieldTypes = config($this->package->shortName() . '.fields')) {
            if (is_array($fieldTypes) && count($fieldTypes) > 0) {
                FieldView::RegisterField($fieldTypes);
            }
        }
        if ($widgetTypes = config($this->package->shortName() . '.widgets')) {
            if (is_array($widgetTypes) && count($widgetTypes) > 0) {
                Dashboard::Register($widgetTypes, $this->package->shortName());
            }
        }
        Platform::Ready(function () {
            add_filter(PLATFORM_HOMEPAGE, function ($view) {
                if (adminUrl() == '') {
                    redirect(route('admin.dashboard'));
                }
                return $view;
            });
            SettingForm::Register(function (\Sokeio\Admin\ItemManager $form) {
                $form->Title('System Information')->Item([
                    Item::Add('page_logo')->Type('images')->Title('Logo')->Attribute(function () {
                        return 'style="max-width:200px;"';
                    }),
    
                    Item::Add('page_site_title')->Column(Item::Col12)->Title('Page Title')->Required(),
    
                    Item::Add('page_description')->Attribute(function () {
                        return 'rows="10"';
                    })->Column(Item::Col12)->Type('tinymce')->Title('Page Description'), //tinymce//textarea
                    Item::Add('page_google_analytics')->Title('Google analytics'),
                    Item::Add('page_google_console')->Title('Google console'),
                ]);
                return $form;
            });
            Menu::Register(function () {
                if (sokeio_is_admin()) {
                    Menu::route('admin.dashboard', __('Dashboard'), '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-dashboard" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M12 13m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                    <path d="M13.45 11.55l2.05 -2.05"></path>
                    <path d="M6.4 20a9 9 0 1 1 11.2 0z"></path>
                 </svg>', [], '', 1);
                    menu::subMenu(__('User'), '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-shield" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M6 21v-2a4 4 0 0 1 4 -4h2"></path>
                    <path d="M22 16c0 4 -2.5 6 -3.5 6s-3.5 -2 -3.5 -6c1 0 2.5 -.5 3.5 -1.5c1 1 2.5 1.5 3.5 1.5z"></path>
                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                 </svg>', function (MenuBuilder $menu) {
                        $menu->setTargetId('user_menu');
                        $menu->route(['name' => 'admin.user-list', 'params' => []], __('User'), '', [], 'admin.user-list');
                        $menu->route(['name' => 'admin.role-list', 'params' => []], __('Role'), '', [], 'admin.role-list');
                        $menu->route(['name' => 'admin.permission-list', 'params' => []], __('Permission'), '', [], 'admin.permission-list');
                    }, 9999999999999);
                    menu::subMenu(__('Appearance'), '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brush" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M3 21v-4a4 4 0 1 1 4 4h-4"></path>
                    <path d="M21 3a16 16 0 0 0 -12.8 10.2"></path>
                    <path d="M21 3a16 16 0 0 1 -10.2 12.8"></path>
                    <path d="M10.6 9a9 9 0 0 1 4.4 4.4"></path>
                 </svg>', function (MenuBuilder $menu) {
                        $menu->setTargetId('system_appearance_menu');
                        $menu->route(['name' => 'admin.theme', 'params' => []], 'Themes', '', [], 'admin.theme');
                        if (Theme::SiteDataInfo()) {
                            $menu->route(['name' => 'admin.theme-options', 'params' => []], 'Theme Options', '', [], 'admin.theme-options');
                        }
                    }, 9999999999999);
                    menu::subMenu('Extension', '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-puzzle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M4 7h3a1 1 0 0 0 1 -1v-1a2 2 0 0 1 4 0v1a1 1 0 0 0 1 1h3a1 1 0 0 1 1 1v3a1 1 0 0 0 1 1h1a2 2 0 0 1 0 4h-1a1 1 0 0 0 -1 1v3a1 1 0 0 1 -1 1h-3a1 1 0 0 1 -1 -1v-1a2 2 0 0 0 -4 0v1a1 1 0 0 1 -1 1h-3a1 1 0 0 1 -1 -1v-3a1 1 0 0 1 1 -1h1a2 2 0 0 0 0 -4h-1a1 1 0 0 1 -1 -1v-3a1 1 0 0 1 1 -1"></path>
                 </svg>', function (MenuBuilder $menu) {
                        $menu->setTargetId('system_extension_menu');
                        $menu->route(['name' => 'admin.module', 'params' => []], 'Modules', '', [], 'admin.module');
                        $menu->route(['name' => 'admin.plugin', 'params' => []], 'Plugins', '', [], 'admin.plugin');
                    }, 9999999999999);
                    menu::subMenu('Settings', '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
       <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z"></path>
       <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
    </svg>', function (MenuBuilder $menu) {
                        $menu->setTargetId('system_setting_menu');
                        $menu->route('admin.setting', 'System Setting', '', [], 'admin.setting');
                    }, 99999999999999);
                }
            });
            if (Request::isMethod('get')) {
                if (sokeio_is_admin()) {
                    add_filter(PLATFORM_CONFIG_JS, function ($rs) {
                        return [
                            ...$rs,
                            'sokeio_shortcode_setting' => route('shortcode-setting'),
                        ];
                    });
                    Menu::DoRegister();
                }
            }
        });
    }
    private function bootGate()
    {
        if (!$this->app->runningInConsole()) {
            add_filter(PLATFORM_PERMISSION_IGNORE, function ($prev) {
                return [
                    'admin.dashboard',
                    'admin.user-change-password-form',
                    'admin.profile',
                    ...$prev
                ];
            });
            add_filter(PLATFORM_PERMISSION_CUSTOME, function ($prev) {
                return [
                    'admin.user-change-status',
                    'admin.role-change-status',
                    'admin.permission-load-data',
                    ...$prev
                ];
            });
        }
    }
    public function packageBooted()
    {
        $this->bootGate();
    }
}
