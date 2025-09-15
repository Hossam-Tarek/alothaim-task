<?php

namespace App\Enums;

enum TaskStatusEnum: int
{
    case PENDING = 0;
    case IN_PROGRESS = 1;
    case COMPLETED = 2;

    public function label(): string
    {
        return match($this) {
            self::PENDING => 'Pending',
            self::IN_PROGRESS => 'In Progress',
            self::COMPLETED => 'Completed',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::PENDING => 'warning',
            self::IN_PROGRESS => 'primary',
            self::COMPLETED => 'success',
        };
    }

    public static function options(): array
    {
        return [
            self::PENDING->value => self::PENDING->label(),
            self::IN_PROGRESS->value => self::IN_PROGRESS->label(),
            self::COMPLETED->value => self::COMPLETED->label(),
        ];
    }
}
