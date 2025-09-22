<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function index()
    {
        // For demo purposes, we'll use static data
        $user = (object) [
            'first_name' => 'Demo',
            'last_name' => 'User',
            'email' => 'demo@cliento.com',
            'company' => 'Cliento CRM',
            'timezone' => 'UTC-05:00 Eastern Time',
            'email_notifications' => true,
            'marketing_emails' => false
        ];
        
        return view('settings.index', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'company' => 'required|string|max:255'
        ]);

        // For demo purposes, we'll just return success
        // In a real app, you'd update the user model
        
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Profile updated successfully']);
        }
        
        return redirect()->route('settings.index')->with('success', 'Profile updated successfully');
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
}