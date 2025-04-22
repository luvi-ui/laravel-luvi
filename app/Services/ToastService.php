<?php

namespace App\Services;

class ToastService
{
    public static function prepare(string $message, ?int $duration = null, $action = null, $actionUrl = null): array
    {
        return [
            'message' => $message,
            'duration' => $duration,
            'action' => $action,
            'action_url' => $actionUrl,
        ];
    }
}
