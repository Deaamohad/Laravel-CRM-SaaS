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
            'job_title' => 'nullable|string|max:255'
        ];
        
        $validatedData = $request->validate($rules);
        
        $user->update($validatedData);
        
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Profile updated successfully']);
        }
        
        return redirect()->route('settings.index')->with([
            'success' => 'Profile updated successfully',
            'active_tab' => 'profile'
        ]);
    }

    public function resetData(Request $request)
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                return redirect()->back()->withErrors(['error' => 'User not authenticated'])->with('active_tab', 'security');
            }
            
            // Clear only the current user's data (order matters due to foreign key constraints)
            // First delete interactions (they reference deals and companies)
            $interactionsDeleted = DB::table('interactions')->where('user_id', $user->id)->delete();
            // Then delete deals (they reference companies)
            $dealsDeleted = DB::table('deals')->where('user_id', $user->id)->delete();
            // Finally delete companies
            $companiesDeleted = DB::table('companies')->where('user_id', $user->id)->delete();
            
            return redirect()->route('settings.index')->with([
                'success' => 'All your data has been reset successfully (Interactions: ' . $interactionsDeleted . ', Deals: ' . $dealsDeleted . ', Companies: ' . $companiesDeleted . ')',
                'active_tab' => 'security'
            ]);
        } catch (\Exception $e) {
            \Log::error('Reset data error: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Error resetting data: ' . $e->getMessage()])->with('active_tab', 'security');
        }
    }

    public function deleteAccount(Request $request)
    {
        try {
            $user = Auth::user();
            
            // Delete only the current user's data (order matters due to foreign key constraints)
            // First delete interactions (they reference deals and companies)
            DB::table('interactions')->where('user_id', $user->id)->delete();
            // Then delete deals (they reference companies)
            DB::table('deals')->where('user_id', $user->id)->delete();
            // Finally delete companies
            DB::table('companies')->where('user_id', $user->id)->delete();
            
            // Delete the user account
            DB::table('users')->where('id', $user->id)->delete();
            
            // Logout the user
            Auth::logout();
            
            return redirect()->route('login')->with('success', 'Your account has been deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Error deleting account: ' . $e->getMessage()])->with('active_tab', 'security');
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