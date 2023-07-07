<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enquiry;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;
use Illuminate\Support\Facades\DB;

class EnquireController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Enquiry $enquiry)
    {         

        DB::beginTransaction(); 
       
        try {
            $enquries = Enquiry::sortable()->latest()->paginate(config('app.limit'))->withQueryString();
          
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('admin.enquries')->with("status", $exception->getMessage());

        }
        return view('backend.enquire.list',compact('enquries'));

    }
  
    public function view(Enquiry $commision,$id)
    {
        DB::beginTransaction();
        try {
            $enquries = Enquiry::find($id);
            DB::commit();
        } catch (ModelNotFoundException $exception) {
            DB::rollBack();
            redirect()->route('enquries.view')->with("status", $exception->getMessage());
        }
        return view('backend.enquire.view', compact('enquries'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
   
    public function delete(Request $request)
    { 
        DB::beginTransaction();
        $id = $request->id;
        try {
            $delete = Enquiry::find($id);
            $delete->delete();
            DB::commit();
        } catch (Exception $exception){
            DB::rollBack();
            redirect()->route('admin.enquries')->with("status", $exception->getMessage());
        }
        return redirect()->back()->with("status", "Your Offer deleted successfully.");
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
            $enquries = Enquiry::sortable()->where('name', 'LIKE', '%' . $data . '%')->paginate(config('app.limit'))->withQueryString();
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('admin.enquries')->with("status", $exception->getMessage());
        }
        return view('backend.enquire.list', compact('enquries'));
    }

    /* change status a newly created resource in db.
    * @param  Request $request
    * @return Response
    */
    public function changeStatus(Request $request)
    {
        DB::beginTransaction();
        try {
            $enquries = Enquiry::find($request->id);
            $enquries->status = !$enquries->status;
            $enquries->save();
            DB::commit();
        } catch (\Exception $exception){
            DB::rollBack();
            redirect()->route('admin.enquries')->with('success', 'Saved!'); 
        }
        return redirect()->route('admin.enquries')->with("status", "Status updated successfully.");
        
    }
}
