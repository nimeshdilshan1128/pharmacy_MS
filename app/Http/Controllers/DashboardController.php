<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CustomersModel;
use App\Models\InvoicesModel;
use App\Models\MedicinesModel;
use App\Models\MedicinesStockModel;
use App\Models\PurchasesModel;
use App\Models\SuppliersModel;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; // Correctly import Str
use File;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $data['TotalCustomers'] = CustomersModel::count();
        $data['TotalMedicines'] = MedicinesModel::count();
        $data['TotalMedicinesStock'] = MedicinesStockModel::count();
        $data['TotalSuppliers'] = SuppliersModel::count();
        $data['TotalInvoices'] = InvoicesModel::count();
        $data['TotalPurchases'] = PurchasesModel::count();
        $data['meta_title'] = 'Dashboard List';

        return view('admin.dashboard.list', $data);
    }

    public function my_account(Request $request)
    {
        // echo "A"; die();
        $data['meta_title'] = 'my_account_update';
        $data['getRecord'] = User::find(Auth::user()->id);
        return view('admin.my_account.update', $data);
    }

    public function my_account_update(Request $request)
    {
        // Validate email input
        $request->validate([
            'email' => 'required|unique:users,email,' . Auth::user()->id,
        ]);

        // Find the user and update their profile
        $save = User::find(Auth::user()->id);
        $save->name = trim($request->name);
        $save->email = trim($request->email);

        // If password is provided, hash and update it
        if (!empty($request->password)) {
            $save->password = Hash::make($request->password);
        }

        // Profile image upload logic
        if (!empty($request->file('profile_image'))) {
            // If the user already has a profile image, delete the old one
            if (!empty($save->profile_image) && file_exists('upload/profile/' . $save->profile_image)) {
                unlink('upload/profile/' . $save->profile_image);
            }

            // Upload new profile image
            $file = $request->file('profile_image');
            $randomStr = Str::random(30);
            $filename = $randomStr . '.' . $file->getClientOriginalExtension();
            $file->move('upload/profile/', $filename);
            $save->profile_image = $filename;
        }

        // Save user data
        $save->save();

        // Redirect to my account page with success message
        return redirect('admin/my_account')->with('success', 'Profile Successfully Updated');
    }
}
