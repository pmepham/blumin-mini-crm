<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    //
    protected $fillable = [
        'name',
        'email',
        'company_name',
        'status',
        'account_reference',
        'territory_code',
    ];

    protected function initials() : Attribute
    {
        return Attribute::make(
            get: function () {
                $parts = explode(' ', trim($this->name));
                $first = $parts[0][0];
                $last = count($parts) > 1 ? end($parts)[0] : '';

                return strtoupper($first . $last);
            }
        );
    }
}
