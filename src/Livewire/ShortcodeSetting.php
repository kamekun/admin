<?php

namespace BytePlatform\Admin\Livewire;

use BytePlatform\Component;
use BytePlatform\Admin\Facades\Shortcode;

class ShortcodeSetting extends Component
{
    public $shortcode = '';
    public $callbackEvent = '';
    public $children = "";
    public  $form = [];
    public function getItemManager()
    {
        return Shortcode::getShortCodeByKey($this->shortcode);
    }
    public function mount()
    {
        $this->shortcode = request('shortcode');
        $this->form = request('attrs');
        $this->children = $this->Base64Decode(request('children'));
        $this->callbackEvent = request('callbackEvent');
        // $this->form->FillData($this->attrs);
    }
    private function getValueText($field)
    {
        return isset($this->form[$field]) ? $this->form[$field] : '';
    }
    private function getShortCodeHtml()
    {
        $html = '[' . $this->shortcode;
        if ($items = $this->getItemManager()?->getItems()) {
            foreach ($items as $item) {
                $value = $this->getValueText($item->getField());
                if ($value) {
                    $html .= ' ' . $item->getField() . '="' . $value . '"';
                }
            }
        }

        $html .= ']' . $this->Base64Encode($this->children) . '[/' . $this->shortcode . ']';
        return   $html;
    }
    public function getShortCodeHtml2()
    {
        $this->closeComponent();
        $this->skipRender();
        return $this->getShortCodeHtml();
    }
    public function doPreview()
    {
        $this->skipRender();
        $shortcode = $this->getShortCodeHtml();
        $shortcodeHtml = shortcode_render($shortcode);
        $pattern = '/wire:id="([^"]+)"/';
        $wireId = '';
        if (preg_match($pattern, $shortcodeHtml, $matches)) {
            $wireId = $matches[1];
        }
        return [
            'shortcode' => $shortcode,
            'shortcodeHtml' => $shortcodeHtml,
            'wireId' => $wireId
        ];
    }
    public function render()
    {
        return view('admin::shortcode-setting', [
            'shortcodes' => Shortcode::GetShortCodes(),
            'shortcodeItem' => $this->getItemManager()
        ]);
    }
}
