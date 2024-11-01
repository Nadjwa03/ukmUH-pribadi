<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Club extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = ['name', 'logo', 'history', 'about'];

    protected $dates = ['deleted_at'];

    protected static function boot()
    {
        parent::boot();

        // Automatically generate a UUID when creating a new club
        static::creating(function ($club) {
            $club->id = (string) Str::uuid();
        });
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
