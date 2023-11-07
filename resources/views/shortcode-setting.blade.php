<div class="p-2">
    <div class="row"
        x-data='{
        async getShortCodeHtml(){
            let html = await $wire.getShortCodeHtml2()
        return html;
    }
}'>
        <div class="col-md-6 col-12">
            <div class="mb-2">
                <label class="form-label">Shortcode:</label>
                <select class=" form-select" wire:model.live='shortcode'>
                    <option>None</option>
                    @if (isset($shortcodes))
                        @foreach ($shortcodes as $key => $item)
                            <option value="{{ $key }}" title="{{ $key }}">
                                {{ $item->getTitle() ?? $key }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            @if (isset($shortcodeItem))
                <div class="row" wire:key='{{ $shortcode }}'>
                    <div class="col-12">
                        <div class=" p-2">
                            <label class="form-label">Attributes:</label>
                            @foreach ($shortcodeItem->getItems() as $item)
                                {!! field_render($item) !!}
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            <div class="mb-2">
                <label class="form-label">Children:</label>
                <textarea wire:tinymce='{}' wire:tinymce-model="children" class="form-control" wire:model='children' name="children"
                    placeholder="children"></textarea>
            </div>
            <div class=" text-center mb-2"><button class="btn btn-blue"
                    @click="{{ $callbackEvent }}(await getShortCodeHtml())">Save
                    Shortcode</button></div>
        </div>
        <div class="col-md-6 col-12" x-data="{
            shortcode: '',
            shortcodeHtml: '',
            shortcodeWireId: '',
            async doPreview() {
                let rs = await this.$wire.doPreview();
                if (this.shortcodeWireId != '') {
                    Livewire.find(this.shortcodeWireId)?.__instance?.cleanup();
                }
                this.shortcode = rs['shortcode'];
                this.shortcodeHtml = rs['shortcodeHtml'];
                this.shortcodeWireId = rs['wireId'];
            }
        }" x-init="doPreview">
            <button class=" btn btn-cyan" @click='doPreview()'>Preview</button>
            <div x-html="shortcode" class=" p-1 border border-1 border-azure text-bg-warning  mt-2  rounded-1 "
                style="overflow-wrap:break-word">
            </div>
            <div x-html="shortcodeHtml" class="p-1 border border-1 border-azure rounded-1 mt-2"
                style="overflow-wrap:break-word">
            </div>
        </div>
    </div>
</div>