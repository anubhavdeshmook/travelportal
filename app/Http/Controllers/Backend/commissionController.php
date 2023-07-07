<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\Commision;
use App\Models\Email;
use App\Models\Country;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Destination;
use Exception;
use Illuminate\Support\Facades\DB;

class commissionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Commision $commision)
    {   
       

        DB::beginTransaction(); 
       
        try {
            $commision = Commision::with('Country')->sortable()->latest()->paginate(config('app.limit'))->withQueryString();
          
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('admin.commission')->with("status", $exception->getMessage());

        }
        return view('backend.commission.list',compact('commision'));

    }

    /**
     * View listing of the resource.
     * @return Response
     */
    public function view(Commision $commision,$id)
    {
        DB::beginTransaction();
        try {
            $commision = Commision::with('Country')->find($id);
            DB::commit();
        } catch (ModelNotFoundException $exception) {
            DB::rollBack();
            redirect()->route('commission.view')->with("status", $exception->getMessage());
        }
        return view('backend.commission.view', compact('commision'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
     
        DB::beginTransaction();
        try {
            $commision = Commision::get();
            $destinations = Country::get();
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('admin.commission.create')->with("status", $exception->getMessage());
        }
     
        return view('backend.commission.create',compact('commision','destinations'));
    }
    
    /**
     * Edit the form for creating a resource.
     * @return Response
     */
    public function edit(Commision $Commision,$id)
    {
        DB::beginTransaction();
        try {
            $commision = Commision::find($id);
            $destinations = Country::get();
            DB::commit();
           
        } catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('admin.commission')->with("status", $exception->getMessage());
    
        }
        return view('backend.commission.edit', compact('commision','destinations'));
    }

    /* Store a newly created resource in db.
    * @param  Request $request
    * @return Response
    */
    public function save(Request $request)
   {
       
    DB::beginTransaction();  
  
        try{ 
            
            $requestData = $request->all();
            $requestData['status'] = (isset($requestData['status'])) ? 1 : 0;           
            Commision::create($requestData);          
            DB::Commit();
        }
        catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('admin.commission.create')->with("status", $exception->getMessage());
        }
        
        return redirect()->route('admin.commission')->with("status", "Your record has been saved successfully.");
    }

    /* Update a newly created resource in db.
    * @param  Request $request
    * @return Response
    */

    public function update(Request $request)
    {
        DB::beginTransaction();
      
        try{
            $commision = Commision::all();
            $commision = Commision::find($request->id);
            $requestData = $request->all();
            $requestData['status'] = (isset($requestData['status'])) ? 1 : 0;  
            if (empty($commision)) {
                throw new Exception("Commission not found");
            }
            $commision->fill($requestData)->save();
            DB::commit();
        }
        catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('admin.commission')->with("status", $exception->getMessage());
        }
        return redirect()->route('admin.commission')->with("status", "Your record has been updated successfully.");
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
            $delete = Commision::find($id);
            $delete->delete();
            DB::commit();
        } catch (Exception $exception){
            DB::rollBack();
            redirect()->route('admin.offers')->with("status", $exception->getMessage());
        }
        return redirect()->back()->with("status", "Your record deleted successfully.");
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
            $commision = Commision::sortable()->where('name', 'LIKE', '%' . $data . '%')->paginate(config('app.limit'))->withQueryString();
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('admin.commission')->with("status", $exception->getMessage());
        }
        return view('backend.commission.list', compact('commision'));
    }

    /* change status a newly created resource in db.
    * @param  Request $request
    * @return Response
    */
    public function changeStatus(Request $request)
    {
        DB::beginTransaction();
        try {
            $commision = Commision::find($request->id);
            $commision->status = !$commision->status;
            $commision->save();
            DB::commit();
        } catch (\Exception $exception){
            DB::rollBack();
            redirect()->route('admin.commission')->with('success', 'Saved!'); 
        }
        return redirect()->route('admin.commission')->with("status", "Status updated successfully.");
        
    }
}
