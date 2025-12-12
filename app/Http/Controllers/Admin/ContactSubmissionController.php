<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactSubmissionController extends Controller
{
    public function index()
    {
        $submissions = \App\Models\ContactSubmission::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.contact_submissions.index', compact('submissions'));
    }

    public function show(\App\Models\ContactSubmission $contactSubmission)
    {
        if (!$contactSubmission->is_read) {
            $contactSubmission->update(['is_read' => true]);
        }
        return view('admin.contact_submissions.show', compact('contactSubmission'));
    }

    public function destroy(\App\Models\ContactSubmission $contactSubmission)
    {
        $contactSubmission->delete();
        return redirect()->route('admin.contact-submissions.index')
            ->with('success', 'Submission deleted successfully.');
    }
}
