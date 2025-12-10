<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $socialLinks = SocialLink::orderBy('sort_order')->get();
        return view('admin.social_links.index', compact('socialLinks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    private function getIcons()
    {
        return [
            'fa-brands fa-github' => 'GitHub',
            'fa-brands fa-linkedin' => 'LinkedIn',
            'fa-brands fa-instagram' => 'Instagram',
            'fa-brands fa-twitter' => 'Twitter/X',
            'fa-brands fa-facebook' => 'Facebook',
            'fa-brands fa-youtube' => 'YouTube',
            'fa-brands fa-tiktok' => 'TikTok',
            'fa-brands fa-discord' => 'Discord',
            'fa-brands fa-stack-overflow' => 'Stack Overflow',
            'fa-brands fa-medium' => 'Medium',
            'fa-brands fa-dev' => 'Dev.to',
            'fa-solid fa-envelope' => 'Email',
            'fa-solid fa-globe' => 'Website',
            'fa-solid fa-link' => 'Other Link',
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $icons = $this->getIcons();
        return view('admin.social_links.create', compact('icons'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'platform' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'icon_class' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['sort_order'] = $request->input('sort_order', 0);

        SocialLink::create($validated);

        return redirect()->route('admin.social-links.index')
            ->with('success', 'Social link created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SocialLink $socialLink)
    {
        $icons = $this->getIcons();
        return view('admin.social_links.edit', compact('socialLink', 'icons'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SocialLink $socialLink)
    {
        $validated = $request->validate([
            'platform' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'icon_class' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['sort_order'] = $request->input('sort_order', 0);

        $socialLink->update($validated);

        return redirect()->route('admin.social-links.index')
            ->with('success', 'Social link updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SocialLink $socialLink)
    {
        $socialLink->delete();

        return redirect()->route('admin.social-links.index')
            ->with('success', 'Social link deleted successfully.');
    }
}
