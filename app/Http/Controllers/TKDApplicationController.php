<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\TKDApplication;

class TKDApplicationController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('Programs/Taekwondo/Application');
    }

    public function store(): Response
    {
        $application = TKDApplication::create(request()->all());
        $application->syncWithProfile();
        $application->save();

        return redirect()->route('tkd-applications.index')->with('success', 'Application submitted successfully.');
    }
}
