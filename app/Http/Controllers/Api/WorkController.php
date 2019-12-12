<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use App\CustomerWork;
use App\Http\Controllers\Controller;
use App\Work;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function contaLavori(){
        $lavorinonterminati = DB::table('works')->where('finished',0)->count();
        $lavoriterminati = DB::table('works')->where('finished',1)->count();

        return response()->json(compact('lavorinonterminati','lavoriterminati'));
    }



    public function index()
    {
        $work = CustomerWork::select('customers.company','work_type','dead_line','finished','information','name')
            ->join('customers', 'customer_works.customer_id','=','customers.id')
            ->join('works', 'customer_works.work_id','=','works.id')
            ->join('users', 'customer_works.user_id','=','users.id')
            ->get();

        return response()->json($work);
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

            'work_type'=>'required',
            'dead_line'=>'required',
            'finished'=>'required',
            'information'=>'required',

        ]);

        $newWork = new Work;
        $newWork->fill($validatedData);
        $newWork->save();
	
	CustomerWork::create(['customer_id' => '','work_id' => '','user_id' => '']);
	//$newWork->customers()->sync(['user_id','customer_id']);

       //  $newWork->users()->attach('user_id');
       //  $newWork->customers()->attach('customer_id');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
