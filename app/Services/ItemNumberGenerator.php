<?php

namespace App\Services;

class ItemNumberGenerator
{
    /**
     * 冊子管理番号を生成する
     *
     * 例: LIB-010008-03
     */
    public static function generate(int $bookId, int $index): string
    {
        return sprintf(
            'LIB-%06d-%02d',
            $bookId,
            $index
        );
    }
}
