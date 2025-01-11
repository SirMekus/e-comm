<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class PayableItem extends Model
{
    protected $guarded = [];
    protected $appends = [
        'created_at_formatted', 'amount_formatted',
    ];

    // public function getRouteKeyName()
    // {
    //     return 'uuid';
    // }
    protected static function boot()
    {
        // Boot other traits on the Model
        parent::boot();

        static::creating(function ($model) {
            $model->setAttribute('uuid', Str::uuid()->toString());
        });
    }

    protected function createdAtFormatted(): Attribute
    {
        return Attribute::make(
            get: function (): string {
                return $this->created_at->toDayDateTimeString();
            },
        );
    }

    protected function amountFormatted(): Attribute
    {
        return Attribute::make(
            get: function (): string {
                return number_format($this->price,2);
            },
        );
    }
}
