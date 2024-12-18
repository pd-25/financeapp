<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class BureauAddress extends Model
{
    protected $fillable = ["name","address","city","state","zipcode","phone","fax"];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->slug = static::generateUniqueSlug($user->name);
        });
    }

    /**
     * Generate a unique slug for the user.
     *
     * @param  string  $name
     * @return string
     */
    protected static function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;

        while (BureauAddress::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . time();
        }

        return $slug;
    }
}
