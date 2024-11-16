<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Club;
use Illuminate\Http\Request;

class AccomplishmentController extends Controller
{
    public function index(string $clubId)
    {
        $club = Club::findOrFail($clubId);

        return view('admin.club.accomplishment.index', ['club' => $club]);
    }
}
