<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'logo',
        'color',
        'header_background_image',
        'website',
        'facebook',
        'twitter',
        'instagram',
    ];

    /**
     * @var string[]
     */
    protected $appends = ['logo_full_path'];

    /**
     * @return string
     */
    public function getLogoFullPathAttribute()
    {
        return asset($this->logo);
    }
}
