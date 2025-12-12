<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Experience $experience)
    {
        if (!$experience->is_active) {
            abort(404);
        }
        
        // Eager load projects that are active and sorted
        $projects = $experience->projects()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('experience.show', compact('experience', 'projects'));
    }
}
