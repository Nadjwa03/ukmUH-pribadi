<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Club extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

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

    public function accomplishments()
    {
        return $this->hasMany(ClubAccomplishment::class);
    }

    public function documentations()
    {
        return $this->hasMany(ClubDocumentation::class);
    }

    public function events()
    {
        return $this->hasMany(ClubEvent::class);
    }
}
