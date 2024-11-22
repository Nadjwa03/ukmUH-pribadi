<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClubEvent extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = ['image', 'club_id'];

    protected $dates = ['deleted_at'];

    public function club()
    {
        return $this->belongsTo(Club::class);
    }
}