<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Instruction extends Model
{
    protected $fillable = ["slug", "name", "instruction"];

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

        while (Instruction::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . time();
        }

        return $slug;
    }
    
}