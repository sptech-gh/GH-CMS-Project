<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChurchSlugRedirect extends Model
{
    protected $fillable = ['church_id', 'old_slug'];
}
