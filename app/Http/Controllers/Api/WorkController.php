<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use App\CustomerWork;
use App\Http\Controllers\Controller;
use App\Work;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Notifications\WorkAdded;
// use Nexmo\Laravel\Facade\Nexmo;

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
        $work = CustomerWork::select('works.id','customers.company','work_type','dead_line','finished','information','name')
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
            'user_id' => 'required',
            'customer_id' => 'required',

        ]);

      
      $nuovoLavoro = Work::create($validatedData);
        CustomerWork::create(['customer_id' => $validatedData['customer_id'],'work_id' => $nuovoLavoro -> id ,'user_id' => $validatedData['user_id']]);
      
      $nameCostumer = CustomerWork::select('customers.company')
        ->join('customers','customer_id','=','customers.id')
        ->where('customers.id',$validatedData['customer_id'])
        ->first();
      
      $nome = json_decode($nameCostumer, true);
      $nomeString = implode( $nome );

      $nuovoLavoro->notify(new WorkAdded($nomeString, $validatedData['work_type']));
      
        //$nuovoLavoro->notify(new WorkAdded($validatedData['customer_id']));

        // $data->notify(new WorkAdded);
         
      //questo è un servizio a pagamento per inviare sms di notifica all'inserimento di ogni nuovo lavoro
        //Nexmo::message()->send([
          // 'to'   => '393939471610',
           // 'from' => 'CRM-WAP',
           // 'text' => 'Nuovo lavoro inserito'
        // ]);
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
//        $work = Work::find($id);
//        $customerWork = CustomerWork::where('work_id',$id)->get();

        $work = CustomerWork::select('works.id','customers.company','work_type','dead_line','finished','information','name','users.name')
            ->join('customers', 'customer_works.customer_id','=','customers.id')
            ->join('works', 'customer_works.work_id','=','works.id')
            ->join('users', 'customer_works.user_id','=','users.id')
            ->where('works.id', $id)
            ->get();


        if (empty($work)) {
            return abort(404);
        }

        return response()->json($work);
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
        $work = Work::find($id);
        if (empty($work)) {
            return response()->json([
                'error' => 'id inesistente'
            ]);
        }
        $work->update($data);
      
         $user_id = CustomerWork::where('work_id',$id)->first();     
         $user_id->user_id = $data['user_id'];
         $user_id->save();
      
     
        return response()->json($work);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $work = Work::find($id);
        $work->delete();
    }
}
