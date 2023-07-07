<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Currency;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\CurrencyRequest;
use Exception;
use Illuminate\Support\Facades\DB;

class CurrnencyController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Currency $currency)
    {          
        DB::beginTransaction(); 
             
        try {
            $currency = Currency::sortable()->latest()->paginate(config('app.limit'))->withQueryString();
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('admin.currency')->with("status", $exception->getMessage());

        }
        return view('backend.currency.list',compact('currency'));
    }

    /**
     * View listing of the resource.
     * @return Response
     */
    public function view(Currency $currency,$id)
    {
        DB::beginTransaction();
        try {
            $currency = Currency::find($id);
         
            DB::commit();
        } catch (ModelNotFoundException $exception) {
            DB::rollBack();
            redirect()->route('admin.currency.view')->with("status", $exception->getMessage());
        }
        return view('backend.currency.view', compact('currency'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        DB::beginTransaction();
        try {
            $currency = Currency::all();
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('admin.currency.create')->with("status", $exception->getMessage());
        }
        return view('backend.currency.create',compact('currency'));
    }
    
    /**
     * Edit the form for creating a resource.
     * @return Response
     */
    public function edit(Currency $currency,$id)
    {
        DB::beginTransaction();
        try {
            $currency = Currency::find($id);
            DB::commit();
            if (empty($currency)) {
                throw new Exception("Currency not found");
            }
        } catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('admin.currency.edit')->with("status", $exception->getMessage());
    
        }
        return view('backend.currency.edit', compact('currency'));
    }

    /* Store a newly created resource in db.
    * @param  Request $request
    * @return Response
    */
    public function save(CurrencyRequest $request)
   {
    DB::beginTransaction(); 
        try{    
            $requestData = $request->all();
            $requestData['status'] = (isset($requestData['status'])) ? 1 : 0;              
            Currency::create($requestData); 
            DB::Commit();         
        }
        catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('admin.currency.create')->with("status", $exception->getMessage());
        }
        
        return redirect()->route('admin.currency')->with("status", "Your record has been saved successfully.");
    }

    /* Update a newly created resource in db.
    * @param  Request $request
    * @return Response
    */

    public function update(CurrencyRequest $request)
    {
      
        DB::beginTransaction();
        try{
            $currency = Currency::all();
            $currency = Currency::find($request->id);
            $requestData = $request->all();
            $requestData['status'] = (isset($requestData['status'])) ? 1 : 0;  
            if (empty($currency)) {
                throw new Exception("Email not found");
            }
            $currency->fill($requestData)->save();
            DB::commit();
        }
        catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('admin.currency')->with("status", $exception->getMessage());
        }
        return redirect()->route('admin.currency')->with("status", "Your record has been updated successfully.");
    }

    /* Delete a newly created resource in db.
    * @param  Request $request
    * @return Response
    */
    public function delete(Request $request)
    { 
        DB::beginTransaction();
        $id = $request->id;
        try {
            $delete = Currency::find($id);
            $delete->delete();
            DB::commit();
        } catch (Exception $exception){
            DB::rollBack();
            redirect()->route('admin.currency.list')->with("status", $exception->getMessage());
        }
        return redirect()->back()->with("status", "Your Record deleted successfully.");
    }

    /* Search a newly created resource in db.
    * @param  Request $request
    * @return Response
    */
    public function search(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->input('search');
            $currency = Currency::sortable()->where('name', 'LIKE', '%' . $data . '%')->orWhere('code', 'LIKE', '%' . $data . '%')->paginate(config('app.limit'))->withQueryString();
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('admin.currency')->with("status", $exception->getMessage());
        }
        return view('backend.currency.list', compact('currency'));
    }

    /* change status a newly created resource in db.
    * @param  Request $request
    * @return Response
    */
    public function changeStatus(Request $request)
    {
        DB::beginTransaction();
        try {
            $currency = Currency::find($request->id);
            $currency->status = !$currency->status;
            $currency->save();
            DB::commit();
        } catch (\Exception $exception){
            DB::rollBack();
            redirect()->route('admin.currency')->with('success', 'Saved!'); 
        }
        return redirect()->route('admin.currency')->with("status", "Status updated successfully.");
        
    }
}
