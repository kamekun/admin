<?php

namespace BytePlatform\Admin;

use BytePlatform\Admin\Facades\Menu;
use Illuminate\Support\ServiceProvider;
use BytePlatform\Laravel\ServicePackage;
use BytePlatform\Concerns\WithServiceProvider;
use BytePlatform\Facades\Platform;
use BytePlatform\Item;
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
            if (Request::isMethod('get')) {
                // Only Get Request
                if (!Platform::checkFolderPlatform()) Platform::makeLink();
                if (byte_is_admin()) {
                    add_filter(PLATFORM_CONFIG_JS, function ($rs) {
                        return [
                            ...$rs,
                            'byte_shortcode_setting' => route('shortcode-setting'),
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
            add_filter(PLATFORM_PERMISSION_CUSTOME, function ($prev) {
                return [
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
