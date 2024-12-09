<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Client extends Model
{
   protected $fillable = ["first_name","middle_name","last_name","email","is_notify_email","dob","ssn","phone","phone_home","phone_work","current_address","city","state","zipcode","billing_address","billing_city","billing_state","billing_zipcode","occupation","anual_income", "slug"];

   /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->slug = static::generateUniqueSlug($user->first_name);
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

        while (Client::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . time();
        }

        return $slug;
    }
}
