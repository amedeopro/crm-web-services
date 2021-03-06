<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use App\CustomersPassword;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function contaClienti(){
        $contaclienti = DB::table('customers')->count();

        return response()->json($contaclienti);
    }

    public function index()
    {
        $customer = Customer::all();
      
//         $customerpassword = CustomerPassword::select('customers.id','customerspassword.*')
//         ->join('customers','customer_id','=','customers.id')
//         ->get();
      
      
        return response()->json($customer);
        //return response()->json(compact('customer','customerpassword');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = $request->all();

        $validatedData = $request->validate([

            'company'=>'required',
            'ref_name'=>'required',
            'phone'=>'required',
            'mail'=>'required',

        ]);

        $newCustomer = new Customer;
        $newCustomer->fill($validatedData);
        $newCustomer->save();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);
        if (empty($customer)) {
            return abort(404);
        }

        return response()->json($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $customer = Customer::find($id);
        if (empty($customer)) {
            return response()->json([
                'error' => 'id inesistente'
            ]);
        }
        $customer->update($data);
      
        return response()->json($customer);
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
    }
}
