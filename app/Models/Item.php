<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Item extends Model
{
    protected $fillable = ["slug", "name", "client_id", "item_type"];

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

        while (Item::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . time();
        }

        return $slug;
    }

    public function itemDetails()
    {
        return $this->hasMany(ItemDetail::class, 'item_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, "client_id", 'id');
    }
}
