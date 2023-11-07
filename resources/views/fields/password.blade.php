@php
    $dataOptions = $item->getDataOption();
    $modelField = $item->getModelField();
@endphp
<div {!! $item->getAttributeContent() !!} x-data="{ showPass: false }">
    @if (!$item->getManager()->IsTable())
        <label class="form-label">{{ $item->getTitle() ?? $item->getField() }}</label>
    @endif
    <div class="input-group input-group-flat">
        <input type="password" :type="showPass ? 'text' : 'password'" {!! $item->getAttribute() ?? '' !!} class="form-control"
            wire:model='{{ $modelField }}' name="{{ $item->getModelField() }}"
            placeholder="{{ $item->getPlaceholder() }}" autocomplete="off" />
        <span class="input-group-text">
            <a href="#" class="link-secondary" @click=" showPass = !showPass " x-show="!showPass"
                title="Show password" data-bs-toggle="tooltip">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                    <path
                        d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" />
                </svg>
            </a>
            <a href="#" class="link-secondary" @click=" showPass = !showPass " x-show="showPass"
                title="Show password" data-bs-toggle="tooltip">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye-off" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M10.585 10.587a2 2 0 0 0 2.829 2.828"></path>
                    <path
                        d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87">
                    </path>
                    <path d="M3 3l18 18"></path>
                </svg>
            </a>

        </span>
    </div>
    @error($modelField)
        <div>
            <span class="error">{{ $message }}</span>
        </div>
    @enderror
</div>
