@php
    $dataOptions = $item->getDataOption();
    $modelField = $item->getModelField();
    $titleField = $item->getTitle() ?? $item->getField();
@endphp
<div {!! $item->getAttributeContent() !!} x-data="{ dataItems: [] }">
    @if (!$item->getManager()->IsTable())
        <label class="form-label">{{ $titleField }}</label>
    @endif
    <button {!! $item->getAttribute() ?? '' !!} sokeio:modal-choose="{{ $dataOptions['modal-choose'] ?? '' }}"
        sokeio:modal="{{ $dataOptions['modal'] ?? '' }}" sokeio:modal-title="{{ $dataOptions['modal-title'] ?? '' }}"
        sokeio:modal-size="{{ $dataOptions['modal-size'] ?? '' }}" sokeio:model="{{ $modelField }}" class="btn btn-blue btn-sm">
        <span class="dz-default dz-message">Choose {{ $titleField }}</span>

    </button>
    <div wire:ignore x-show="$wire.{{ $modelField }}" x-data="{
        dataItemIds: function() {
            return $wire.{{ $modelField }};
        }
    }">
        {!! $item->getDataText() !!}
    </div>
    @error($modelField)
        <div>
            <span class="error">{{ $message }}</span>
        </div>
    @enderror
</div>
