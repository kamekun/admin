@php
    $dataOptions = $item->getDataOption();
    $modelField = $item->getModelField();
@endphp
<div {!! $item->getAttributeContent() !!}>
    @if (!$item->getManager()->IsTable())
        <label class="form-label">{{ $item->getTitle() ?? $item->getField() }}</label>
    @endif
    <input {!! $item->getAttribute() ?? '' !!} type="range" class="form-range" wire:model='{{ $modelField }}'
        name="{{ $modelField }}" placeholder="{{ $item->getPlaceholder() }}">
    @error($modelField)
        <div>
            <span class="error">{{ $message }}</span>
        </div>
    @enderror
</div>
