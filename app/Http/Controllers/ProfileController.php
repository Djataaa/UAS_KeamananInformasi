<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Show the update profile page.
     *
     * @param  Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(Request $request)
    {
        return view('profile.edit', [
            'user' => $request->user()
        ]);
    }
    
    /**
    * Update user's profile
    *
    * @param  Request $request
    * @return \Illuminate\Contracts\Support\Renderable
    */
    public function update(UpdateProfileRequest $request)
    {
        $request->user()->update(
            $request->all()
        );

        if($request == null){
            return redirect()->route('profile.edit')
            ->with('error','Profile gagal diubah!');
        } else {
            return redirect()->route('profile.edit')
            ->with('success','Profile berhasil diubah!');
        }
    }

    /**
     * @param UpdatePasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $request->user()->update([
            'password' => Hash::make($request->get('password'))
        ]);

        if($request == null){
            return redirect()->route('profile.edit')
            ->with('error','Password gagal diubah!');
        } else {
            return redirect()->route('profile.edit')
            ->with('success','Password berhasil diubah!');
        }
    }
}
