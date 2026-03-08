<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('app.sr_vorlage_offset', '0');
        $this->migrator->add('app.stapi_vorlage_offset', '0');
        $this->migrator->add('app.gr_vorlage_offset', '0');
    }
};
