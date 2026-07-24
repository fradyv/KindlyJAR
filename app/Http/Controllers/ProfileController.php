<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            'pp'                    => ['nullable', 'image', 'max:2048'],
            'bio'                   => ['nullable', 'string', 'max:1000'],
            'is_anonymous_donation' => ['nullable', 'boolean'],
        ]);

        $user = $this->authUserFromRequest($request);

        $data = [
            'display_name'          => $validated['display_name'],
            'bio'                   => $validated['bio'] ?? null,
            'is_anonymous_donation' => $request->boolean('is_anonymous_donation'),
        ];

        if ($request->hasFile('pp')) {
            $data['avatar_url'] = 'storage/'.Storage::disk('public')->put('users', $request->file('pp'));
        }

        $user->update($data);

        return back()->with('success', 'Perubahan profil berhasil disimpan.');
    }
}
