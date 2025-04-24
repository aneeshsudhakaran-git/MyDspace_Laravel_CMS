<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('admin.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $user = $request->user();
        $image = $request->file('image');
        $old_image = $user->image;

        // Handle image upload
        $del_image = $request->del_image; 
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Store new image
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('profile-images', $filename, 'public');
            $user->image = $path;
        }

        if ((isset($del_image) && $del_image != '') || (isset($image) && $request->file('image')->isValid()) ) {
            // delete old image
            if( Storage::disk('public')->exists('profile-images/'.$old_image) ){
                Storage::disk('public')->delete('profile-images/'.$old_image);
            }
        }

        if(isset($filename) && $filename != '')  
            $user->image = $filename;
        if(isset($del_image) && $del_image != '')  
            $user->image = '';

        $user->save();
        return Redirect::route('admin.profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        Auth::guard('admin')->logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/admin');
    }
}
