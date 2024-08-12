<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerModel;

class CustomersController extends Controller
{
    public function customers(Request $request){
        $data['getRecord'] = CustomerModel::get();
        return view('admin.customers.list', $data);
    }

    public function add_customers(Request $request)
    {
        return view('admin.customers.add');
    }

    public function insert_add_customers(Request $request)
    {
        //dd($request->all());

        $save = new CustomerModel;
        $save->name = trim($request->name);
        $save->contact_number = trim($request->contact_number);
        $save->address = trim($request->address);
        $save->docter_name = trim($request->docter_name);
        $save->docter_address = trim($request->docter_address);
        $save->save();

        return redirect('admin/customers')->with('success', 'Customer Successfully Added.');

    }

    public function edit_customers($id, Request $request){
        //echo $id;die();
        $data['getRecord'] = CustomerModel::find($id);
        return view('admin.customers.edit', $data);
    }

    public function update_customers($id, Request $request)
    {
        $save = CustomerModel::find($id);
        $save->name = trim($request->name);
        $save->contact_number = trim($request->contact_number);
        $save->address = trim($request->address);
        $save->docter_name = trim($request->docter_name);
        $save->docter_address = trim($request->docter_address);
        $save->save();

        return redirect('admin/customers')->with('success', 'Customer Successfully Update.');
    }

    public function delete_customers($id){
        //echo $id;die();
        $delete_record = CustomerModel::find($id);
        $delete_record->delete();
        return redirect('admin/customers')->with('success', 'Customer Successfully Deleted.');
    }


}

?>
  