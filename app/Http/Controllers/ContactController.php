<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contactConfig = \App\Models\Setting::where('key', 'contact_form_config')->value('value');
        $fields = $contactConfig ? json_decode($contactConfig, true) : [];

        // Fallback if no config exists
        if (empty($fields)) {
             $fields = [
                ['name' => 'name', 'label' => 'Name', 'type' => 'text', 'required' => true],
                ['name' => 'email', 'label' => 'Email', 'type' => 'email', 'required' => true],
                ['name' => 'message', 'label' => 'Message', 'type' => 'textarea', 'required' => true],
            ];
        }

        return view('contact', compact('fields'));
    }

    public function store(Request $request)
    {
        $contactConfig = \App\Models\Setting::where('key', 'contact_form_config')->value('value');
        $fields = $contactConfig ? json_decode($contactConfig, true) : [];
        
        // Build Validation Rules
        $rules = [];
        foreach ($fields as $field) {
            $rule = [];
            if ($field['required']) {
                $rule[] = 'required';
            } else {
                $rule[] = 'nullable';
            }
            
            if ($field['type'] === 'email') {
                $rule[] = 'email';
            }
            // Add more type-specific validation if needed
            
            $rules[$field['name']] = $rule;
        }

        $validated = $request->validate($rules);

        // Separate standard fields from payload
        $standardFields = ['name', 'email', 'message'];
        $payload = [];
        
        foreach ($validated as $key => $value) {
            if (!in_array($key, $standardFields)) {
                $payload[$key] = $value;
            }
        }

        // Store Submission
        $submission = \App\Models\ContactSubmission::create([
            'name' => $validated['name'] ?? 'N/A', // Fallback if name is removed from config (unlikely but safe)
            'email' => $validated['email'] ?? 'no-reply@example.com',
            'message' => $validated['message'] ?? '',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'payload' => $payload,
        ]);

        // Send Email
        $contactEmail = \App\Models\Setting::where('key', 'contact_email')->value('value') ?? 'admin@example.com';
        \Illuminate\Support\Facades\Mail::to($contactEmail)->send(new \App\Mail\ContactFormSubmitted($submission));

        return back()->with('success', 'Thank you! Your message has been received.');
    }
}
