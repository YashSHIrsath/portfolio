<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactSettingController extends Controller
{
    public function edit()
    {
        $contactEmail = \App\Models\Setting::firstOrCreate(['key' => 'contact_email'], ['value' => 'admin@example.com']);
        $contactConfig = \App\Models\Setting::firstOrCreate(
            ['key' => 'contact_form_config'], 
            ['value' => json_encode([
                ['name' => 'name', 'label' => 'Name', 'type' => 'text', 'required' => true],
                ['name' => 'email', 'label' => 'Email', 'type' => 'email', 'required' => true],
                ['name' => 'message', 'label' => 'Message', 'type' => 'textarea', 'required' => true],
                ['name' => 'company', 'label' => 'Company', 'type' => 'text', 'required' => true],
            ])]
        );

        $fields = json_decode($contactConfig->value, true);
        
        // Ensure company field exists if it was created before this update
        $hasCompany = false;
        foreach ($fields as $field) {
            if ($field['name'] === 'company') {
                $hasCompany = true;
                break;
            }
        }

        if (!$hasCompany) {
            $fields[] = ['name' => 'company', 'label' => 'Company', 'type' => 'text', 'required' => true];
        }

        return view('admin.settings.contact', [
            'contactEmail' => $contactEmail->value,
            'contactConfig' => $fields,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'contact_email' => 'required|email',
            'fields' => 'required|array',
            'fields.*.name' => 'required|string|alpha_dash', // alpha_dash ensures valid input name
            'fields.*.label' => 'required|string',
            'fields.*.type' => 'required|in:text,email,textarea,number',
            'fields.*.required' => 'boolean',
        ]);

        // Update Email
        \App\Models\Setting::updateOrCreate(
            ['key' => 'contact_email'],
            ['value' => $request->contact_email]
        );

        // Update Config
        // Re-index array to ensure it's a JSON array, not object
        $fields = array_values($request->fields);
        
        \App\Models\Setting::updateOrCreate(
            ['key' => 'contact_form_config'],
            ['value' => json_encode($fields)]
        );

        return redirect()->route('admin.contact-settings.edit')
            ->with('success', 'Contact settings updated successfully.');
    }
}
