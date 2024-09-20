<?php

namespace App\Http\Controllers;

use App\Models\PurchasesModel;
use Illuminate\Http\Request;
use App\Models\SuppliersModel;
use App\Models\InvoicesModel;



class PurchasesController extends Controller
{
    public function index(Request $request)
    {
        $data['getRecord'] = PurchasesModel::get();
        return view('admin.purchases.list', $data);
    }

    public function create()
    {
        $data['GetSuppliers'] = SuppliersModel::get();
        $data['GetInvoices'] = InvoicesModel::get();
        return view('admin.purchases.add', $data);
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $save = new PurchasesModel;
        $save->suppliers_id = $request->suppliers_id;
        $save->invoices_id = $request->invoices_id;
        $save->voucher_number = $request->voucher_number;
        $save->purchase_date = $request->purchase_date;
        $save->total_amount = $request->total_amount;
        $save->payment_status = $request->payment_status;
        $save->save();

        return redirect('admin/purchases')->with('success', 'purchases successfully created.');
    }


}
