<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    const COMPANY_LOGO_PATH = 'storage/company/logo';

    protected $fillable = [
        'name',
        'email',
        'logo',
        'website',
    ];

    public function getLogoAttribute($value) {
        return $value ? self::COMPANY_LOGO_PATH. "/" . $value : null;
    }

    public function employees()
    {
        return $this->hasMany('App\Models\Employee', 'company_id', 'id');
    }
}
