<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class DataSettings extends Settings
{
    public string $sr_vorlage_offset;
    public string $stapi_vorlage_offset;
    public string $gr_vorlage_offset;
    public static function group(): string
    {
        return 'app';
    }
}
