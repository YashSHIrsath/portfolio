<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class GitHubSettingController extends Controller
{
    public function edit()
    {
        $username = Setting::where('key', 'github_username')->value('value');
        
        // Check if token is present in environment
        $hasToken = !empty(env('GITHUB_TOKEN'));

        return view('admin.settings.github', compact('username', 'hasToken'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'github_username' => 'required|string|max:255',
        ]);

        Setting::updateOrCreate(
            ['key' => 'github_username'],
            ['value' => $request->github_username]
        );

        return redirect()->route('admin.github-settings.edit')
            ->with('success', 'GitHub settings updated successfully.');
    }
}
