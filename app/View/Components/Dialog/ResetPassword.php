<?php

namespace App\View\Components\Dialog;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ResetPassword extends Component
{
    public $modalId, $title, $message, $action, $confirmText, $cancelText;
    /**
     * Create a new component instance.
     */
    public function __construct(string $modalId, string $title, string $message, string $action, string $confirmText, string $cancelText)
    {
        $this->modalId = $modalId;
        $this->title = $title;
        $this->message = $message;
        $this->action = $action;
        $this->confirmText = $confirmText;
        $this->cancelText = $cancelText;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dialog.reset-password');
    }
}
