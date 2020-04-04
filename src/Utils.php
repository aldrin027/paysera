<?php declare(strict_types=1)?>
<?php

namespace Utils;


class Helper {

    public static function isEu(string $code): bool
    {
        $moneyCode = ['AT','BE','BG','CY','CZ','DE','DK','EE','ES','FI','FR','GR','HR','HU','IE','IT','LT','LU','LV','MT','NL','PO','PT','RO','SE','SI','SK'];

        if(!in_array($code, $moneyCode)) {
            return false;
        }

        return true;
    }

    public static function compute(float $amount, bool $isEu): float
    {
        return ceil($amount) * ($isEu === true ? 0.01 : 0.02);
    }

}