<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Currency;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function show(): View
    {
        return view('settings', [
            'currencies' => Currency::all(),
        ]);
    }
    public function setSettings(ProfileUpdateRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $request->user()->fill($validatedData);
        $request->user()->save();
        return Redirect::route('settings')->with('status', 'currency-updated');
    }
}
