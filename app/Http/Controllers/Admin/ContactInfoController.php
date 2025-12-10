<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use Illuminate\Http\Request;

class ContactInfoController extends Controller
{
    private function getIcons()
    {
        return [
            'fa-solid fa-phone' => 'Phone',
            'fa-solid fa-envelope' => 'Email',
            'fa-brands fa-whatsapp' => 'WhatsApp',
            'fa-brands fa-telegram' => 'Telegram',
            'fa-solid fa-location-dot' => 'Location',
            'fa-solid fa-globe' => 'Website',
            'fa-brands fa-linkedin' => 'LinkedIn',
            'fa-brands fa-skype' => 'Skype',
            'fa-brands fa-discord' => 'Discord',
        ];
    }

    public function index()
    {
        $contactInfos = ContactInfo::orderBy('sort_order')->get();
        return view('admin.contact_infos.index', compact('contactInfos'));
    }

    public function create()
    {
        $icons = $this->getIcons();
        return view('admin.contact_infos.create', compact('icons'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'value' => 'required|string|max:255',
            'icon_class' => 'required|string|max:255',
            'link' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'active' => 'boolean',
        ]);

        $validated['sort_order'] = $request->input('sort_order', 0);
        $validated['active'] = $request->has('active');

        ContactInfo::create($validated);

        return redirect()->route('admin.contact-infos.index')
            ->with('success', 'Contact info created successfully.');
    }

    public function edit(ContactInfo $contactInfo)
    {
        $icons = $this->getIcons();
        return view('admin.contact_infos.edit', compact('contactInfo', 'icons'));
    }

    public function update(Request $request, ContactInfo $contactInfo)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'value' => 'required|string|max:255',
            'icon_class' => 'required|string|max:255',
            'link' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'active' => 'boolean',
        ]);

        $validated['sort_order'] = $request->input('sort_order', 0);
        $validated['active'] = $request->has('active');

        $contactInfo->update($validated);

        return redirect()->route('admin.contact-infos.index')
            ->with('success', 'Contact info updated successfully.');
    }

    public function destroy(ContactInfo $contactInfo)
    {
        $contactInfo->delete();
        return redirect()->route('admin.contact-infos.index')
            ->with('success', 'Contact info deleted successfully.');
    }
}
