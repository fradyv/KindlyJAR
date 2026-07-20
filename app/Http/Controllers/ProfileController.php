<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function show(): View
    {
        return view('user-info.profil-saya');
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'display_name'          => ['required', 'string', 'max:255'],
            'bio'                    => ['nullable', 'string', 'max:1000'],
            'is_anonymous_donation'  => ['nullable', 'boolean'],
        ]);

        auth()->user()->update([
            'display_name'          => $validated['display_name'],
            'bio'                    => $validated['bio'] ?? null,
            'is_anonymous_donation'  => $request->boolean('is_anonymous_donation'),
        ]);

        return back()->with('success', 'Perubahan profil berhasil disimpan.');
    }
}
