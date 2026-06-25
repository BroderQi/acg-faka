<?php
declare(strict_types=1);

namespace App\Util;

use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Schema\Blueprint;

class CommoditySchema
{
    private static bool $initialSoldChecked = false;

    public static function ensureInitialSoldColumn(): void
    {
        if (self::$initialSoldChecked) {
            return;
        }

        if (!Manager::schema()->hasColumn('commodity', 'initial_sold')) {
            Manager::schema()->table('commodity', function (Blueprint $blueprint) {
                $blueprint->unsignedInteger('initial_sold')->default(0)->after('stock')->comment('Initial sold count');
            });
        }

        self::$initialSoldChecked = true;
    }
}
