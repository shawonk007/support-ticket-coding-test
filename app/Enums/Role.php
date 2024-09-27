<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

final class Role extends Enum {
    const ADMIN = "admin" ;
    const CUSTOMER = "customer" ;

    public static function fetch() {
        return [
            self::ADMIN,
            self::CUSTOMER,
        ];
    }
}
