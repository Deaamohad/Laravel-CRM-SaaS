<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Rules\CurrentPasswordRule;

class SettingsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        return view('settings.index', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'job_title' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
        
        $validatedData = $request->validate($rules);
        
        // Handle avatar upload if present
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar && Storage::exists('public/avatars/' . $user->avatar)) {
                Storage::delete('public/avatars/' . $user->avatar);
            }
            
            $avatarName = time() . '.' . $request->avatar->extension();
            $request->avatar->storeAs('public/avatars', $avatarName);
            $validatedData['avatar'] = $avatarName;
        }
        
        $user->update($validatedData);
        
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Profile updated successfully']);
        }
        
        return redirect()->route('settings.index')->with([
            'success' => 'Profile updated successfully',
            'active_tab' => 'profile'
        ]);
    }

    public function resetData()
    {
        try {
            // Clear all data from tables
            DB::table('interactions')->delete();
            DB::table('deals')->delete();
            DB::table('companies')->delete();
            
            return response()->json(['success' => true, 'message' => 'All data has been reset successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error resetting data: ' . $e->getMessage()]);
        }
    }

    public function deleteAccount()
    {
        try {
            // In a real app, you'd delete the user and all related data
            // For demo purposes, we'll just clear all data
            DB::table('interactions')->delete();
            DB::table('deals')->delete();
            DB::table('companies')->delete();
            
            return response()->json(['success' => true, 'message' => 'Account deletion initiated. All data has been cleared.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error deleting account: ' . $e->getMessage()]);
        }
    }
    
    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        
        try {
            $request->validate([
                'current_password' => ['required', new CurrentPasswordRule],
                'password' => 'required|string|min:8|confirmed',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput()->with('active_tab', 'security');
        }
        
        // Update password if current password is correct
        if (Hash::check($request->current_password, $user->password)) {
            DB::table('users')
                ->where('id', $user->id)
                ->update([
                    'password' => Hash::make($request->password)
                ]);
            
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => true, 'message' => 'Password updated successfully']);
            }
            
            return redirect()->route('settings.index')->with([
                'success' => 'Password updated successfully',
                'active_tab' => 'security'
            ]);
        } else {
            return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.'])->withInput()->with('active_tab', 'security');
        }
    }
}