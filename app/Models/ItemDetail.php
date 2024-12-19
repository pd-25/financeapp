<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemDetail extends Model
{
    protected $fillable = ["slug", "item_id", "bureau_name", "bureau_status", "item_name", "item_type", "account_no", "open_date", "status", "instruction_id"];
}
