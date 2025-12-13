<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key');
        return view('admin.settings.index', compact('settings'));
    }

    public function editAbout()
    {
        $settings = Setting::pluck('value', 'key');
        return view('admin.settings.about', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'profile_image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            // Add other setting validations here as needed
        ]);

        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            $oldImage = Setting::where('key', 'profile_image')->value('value');
            if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                Storage::disk('public')->delete($oldImage);
            }

            $path = $request->file('profile_image')->store('profile', 'public');
            Setting::updateOrCreate(['key' => 'profile_image'], ['value' => $path]);
        }

        if ($request->hasFile('resume')) {
            // Delete old resume if exists
            $oldResume = Setting::where('key', 'resume')->value('value');
            if ($oldResume && Storage::disk('public')->exists($oldResume)) {
                Storage::disk('public')->delete($oldResume);
            }

            $path = $request->file('resume')->store('resumes', 'public');
            Setting::updateOrCreate(['key' => 'resume'], ['value' => $path]);
        }

        if ($request->has('description')) {
             Setting::updateOrCreate(['key' => 'description'], ['value' => $request->input('description')]);
        }

        if ($request->has('first_name')) {
            Setting::updateOrCreate(['key' => 'first_name'], ['value' => $request->input('first_name')]);
        }

        if ($request->has('last_name')) {
            Setting::updateOrCreate(['key' => 'last_name'], ['value' => $request->input('last_name')]);
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings updated successfully.');
    }
}
