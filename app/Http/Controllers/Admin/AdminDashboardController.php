<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        return view('admin.dashboard', [
            'contactInfoCount' => \App\Models\ContactInfo::count(),
            'techStackCount' => \App\Models\TechStack::count(),
            'socialLinkCount' => \App\Models\SocialLink::count(),
            'typingTextCount' => \App\Models\TypingText::count(),
            'projectCount' => \App\Models\Project::count(),
            'experienceCount' => \App\Models\Experience::count(),
            'latestContacts' => \App\Models\ContactSubmission::latest()->take(3)->get(),
            'unreadContactsCount' => \App\Models\ContactSubmission::where('is_read', false)->count(),
        ]);
    }
}

