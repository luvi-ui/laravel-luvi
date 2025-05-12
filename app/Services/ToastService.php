<?php

namespace App\Services;

use Illuminate\Support\Traits\Macroable;
class ToastService
{
    use Macroable;

    protected string $message;
    protected ?int $duration = null;
    protected ?string $action = null;
    protected ?string $actionUrl = null;
    protected $component = null;

    public function __construct(?string $message = null)
    {
        if ($message) {
            $this->message = $message;
        }
    }

    public static function message(string $message): self
    {
        return new static($message);
    }

    public function duration(?int $duration): self
    {
        $this->duration = $duration;
        return $this;
    }

    public function action(?string $action, ?string $actionUrl = null): self
    {
        $this->action = $action;

        if ($actionUrl) {
            $this->actionUrl = $actionUrl;
        }

        return $this;
    }

    public function actionUrl(?string $actionUrl): self
    {
        $this->actionUrl = $actionUrl;
        return $this;
    }

    public function from($component): self
    {
        $this->component = $component;
        return $this;
    }

    public function dispatch(): void
    {
        if (!isset($this->message) || trim($this->message) === '') {
            throw new \InvalidArgumentException("Toast message cannot be empty");
        }

        $payload = [
            'message' => $this->message,
            'duration' => $this->duration,
            'action' => $this->action,
            'action_url' => $this->actionUrl,
        ];

        $this->component->dispatch('toast', ...[
            'message' => $this->message,
            'duration' => $this->duration,
            'action' => $this->action,
            'action_url' => $this->actionUrl,
        ]);
    }

    public static function success(string $message): self
    {
        return static::message($message);
    }

    public static function error(string $message): self
    {
        return static::message($message);
    }

    public static function info(string $message): self
    {
        return static::message($message);
    }
}