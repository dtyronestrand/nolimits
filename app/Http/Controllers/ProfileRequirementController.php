<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileRequirementController extends Controller
{
    public function update(Request $request, Profile $profile)
    {
        // Check if user owns this profile
        if ($request->user()->profile->id !== $profile->id) {
            abort(403);
        }

        $request->validate([
            'requirement_id' => 'required|string',
            'completed' => 'required|boolean'
        ]);

        $requirementsProgress = $profile->requirements_progress ?? [];
        
        if (isset($requirementsProgress[$request->requirement_id])) {
            $requirementsProgress[$request->requirement_id]['completed'] = $request->completed;
            $profile->update(['requirements_progress' => $requirementsProgress]);
        }

        return back();
    }
}