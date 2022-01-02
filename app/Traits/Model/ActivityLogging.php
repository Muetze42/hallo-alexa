<?php

namespace App\Traits\Model;


use Illuminate\Support\Str;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

trait ActivityLogging
{
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        $logName = !empty($this->logName) ? $this->logName : $this->getLogName();

        return LogOptions::defaults()
            ->dontLogIfAttributesChangedOnly(array_merge($this->hidden, ['created_at', 'updated_at']))
            ->logFillable()
            ->logExcept($this->hidden)
            ->useLogName($logName)
            ->logOnlyDirty();
    }

    protected function getLogName(): string
    {
        $className = Str::kebab(class_basename(get_class($this)));

        return explode('-', $className)[0];
    }
}
