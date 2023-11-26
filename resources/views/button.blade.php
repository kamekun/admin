@php
    $buttonAtrr = $button->getAttribute() ?? '';
    $buttonClass = $button->getClass() ?? '';
    if ($url = $button->getModalUrl()) {
        $buttonAtrr .= ' sokeio:modal="' . $url . '" ';
        if ($size = $button->getModalSize()) {
            $buttonAtrr .= ' sokeio:modal-size="' . $size . '" ';
        }
        if ($title = $button->getModalTitle()) {
            $buttonAtrr .= ' sokeio:modal-title="' . $title . '" ';
        }
    }
    
    if ($confirm = $button->getConfirm()) {
        $buttonAtrr .= ' sokeio:confirm="' . $confirm . '" ';
        if ($confirmYes = $button->getConfirmYes()) {
            $buttonAtrr .= ' sokeio:confirm-yes="' . $confirmYes . '" ';
        }
        if ($confirmNo = $button->getConfirmNo()) {
            $buttonAtrr .= ' sokeio:confirm-no="' . $confirmNo . '" ';
        }
        if ($title = $button->getConfirmTitle()) {
            $buttonAtrr .= ' sokeio:confirm-title="' . $title . '" ';
        }
    }
    if ($target = $button->getTarget()) {
        $buttonAtrr .= ' target="' . $target . '" ';
    }
    
    if ($wireClick = $button->getWireClick()) {
        $buttonAtrr .= ' wire:click="' . $wireClick . '" ';
    }
    if ($buttonLink = $button->getButtonLink()) {
        $buttonAtrr .= 'href="' . $buttonLink . '" ';
    }
    
    if ($buttonType = $button->getButtonType()) {
        $buttonClass .= ' btn-' . $buttonType . ' ';
    }
    
    if ($buttonSize = $button->getButtonSize()) {
        $buttonClass .= ' btn-' . $buttonSize . ' ';
    }
    
@endphp
<a class="btn {{ $buttonClass }}" {!! $buttonAtrr !!}>
    {{ $button->getTitle() }}
</a>
