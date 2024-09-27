<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

final class Status extends Enum {
    const OPEN = "open" ;
    const CLOSE = "close" ;

    public static function fetch() {
        return [
            self::OPEN,
            self::CLOSE,
        ];
    }
}
