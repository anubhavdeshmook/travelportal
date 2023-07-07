<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use App\Models\Destination;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\UserRequest;
use App\Http\Requests\DestinationRequest;
use Exception;
use Illuminate\Support\Facades\DB;



class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Destination $destination)
    {  
       
        DB::beginTransaction();
   
        try {
            $destinations = Destination::with('Country')->sortable()->latest()->paginate(config('app.limit'))->withQueryString();

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('admin.destination')->with("status", $exception->getMessage());

        }
        return view('backend.destination.list', compact('destinations'));
    }

    /**
     * View listing of the resource.
     * @return Response
     */
    public function view(Destination $destination,$id)
    {
        DB::beginTransaction();
        try {
            $destination = Destination::with('Country')->find($id);
            DB::commit();
        } catch (ModelNotFoundException $exception) {
            DB::rollBack();
            redirect()->route('destination.view')->with("status", $exception->getMessage());
        }
        return view('backend.destination.view', compact('destination'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        DB::beginTransaction();
        try {
            $country =Country::get();
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('admin.destination.create')->with("status", $exception->getMessage());
        }
        return view('backend.destination.create',compact('country'));
    }
    
    /**
     * Edit the form for creating a resource.
     * @return Response
     */
    public function edit(Destination $destionation,$id)
    {
        
        DB::beginTransaction();
        try {
            $destination = Destination::find($id);
            $country = Country::get();

            DB::commit();
            if (empty($destination)) {
                throw new Exception("Destination not found");
            }
        } catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('admin.destination.create')->with("status", $exception->getMessage());
    
        }
        return view('backend.destination.edit', compact('destination','country'));
    }

    /* Store a newly created resource in db.
    * @param  Request $request
    * @return Response
    */
    public function save(DestinationRequest $request)
   {
       DB::beginTransaction();
        try{            
            $requestData = $request->all();
            $requestData['status'] = (isset($requestData['status'])) ? 1 : 0;  
            $requestData['is_popular'] = (isset($requestData['is_popular'])) ? 1 : 0; 
            Destination::create($requestData);          
            DB::commit();
        }
        catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('admin.destination.create')->with("status", $exception->getMessage());
        }
        
        return redirect()->route('admin.destination')->with("status", "Your record has been saved successfully.");
    }

    /* Update a newly created resource in db.
    * @param  Request $request
    * @return Response
    */

    public function update(DestinationRequest $request)
    {
      

        DB::beginTransaction();
     
        try{
            $destionations = Destination::all();
            $destionation = Destination::find($request->id);
            $requestData = $request->all();
            $requestData['status'] = (isset($requestData['status'])) ? 1 : 0;  
           
            if (empty($destionation)) {
                throw new Exception("Destionation not found");
            }
            $destionation->fill($requestData)->save();
            DB::commit();
        }
        catch (Exception $exception) {
            DB::rollBack();

            redirect()->route('admin.destination.edit',$request->id)->with("status", $exception->getMessage());
        }
        return redirect()->route('admin.destination')->with("status", "Your record has been updated successfully.");
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
            $delete = Destination::find($id);
            $delete->delete();
            DB::commit();
        } catch (Exception $exception){
            DB::rollBack();
            redirect()->route('admin.destination.list')->with("status", $exception->getMessage());
        }
        return redirect()->back()->with("status", "Destination deleted successfully.");
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
            $destinations = Destination::sortable()->where('name', 'LIKE', '%' . $data . '%')->paginate(config('app.limit'))->withQueryString();
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('admin.destination')->with("status", $exception->getMessage());
        }
        return view('backend.destination.list', compact('destinations'));
    }

    /* change status a newly created resource in db.
    * @param  Request $request
    * @return Response
    */
    public function changeStatus(Request $request)
    {
        DB::beginTransaction();
        try {
            $destionation = Destination::find($request->id);
            $destionation->status = !$destionation->status;
            $destionation->save();
            DB::commit();
        } catch (Exception $exception){
            DB::rollBack();
            redirect()->route('admin.destination')->with('success', 'Saved!'); 
        }
        return redirect()->route('admin.destination')->with("status", "Status updated successfully.");
        
    }
}
