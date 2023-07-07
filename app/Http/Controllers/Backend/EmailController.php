<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Email;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\EmailRequest;
use Exception;
use Illuminate\Support\Facades\DB;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Email $email)
    {          
        DB::beginTransaction(); 
        $emails = [];       
        try {
            $emails = Email::sortable()->latest()->paginate(config('app.limit'))->withQueryString();
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('admin.email')->with("status", $exception->getMessage());

        }
        return view('backend.email.emaillist',compact('emails'));
    }

    /**
     * View listing of the resource.
     * @return Response
     */
    public function view(Email $email)
    {
        DB::beginTransaction();
        try {
            $email = Email::find($email->id);
            DB::commit();
        } catch (ModelNotFoundException $exception) {
            DB::rollBack();
            redirect()->route('email.view')->with("status", $exception->getMessage());
        }
        return view('backend.email.view', compact('email'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        DB::beginTransaction();
        try {
            $email = Email::all();
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('admin.email.create')->with("status", $exception->getMessage());
        }
        return view('backend.email.create',compact('email'));
    }
    
    /**
     * Edit the form for creating a resource.
     * @return Response
     */
    public function edit(Email $email)
    {
        DB::beginTransaction();
        try {
            $email = Email::find($email->id);
            DB::commit();
            if (empty($email)) {
                throw new Exception("Email not found");
            }
        } catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('email.createdite')->with("status", $exception->getMessage());
    
        }
        return view('backend.email.edit', compact('email'));
    }

    /* Store a newly created resource in db.
    * @param  Request $request
    * @return Response
    */
    public function save(EmailRequest $request)
   {
    DB::beginTransaction(); 
    $requestData = $request->all();
            $requestData['status'] = (isset($requestData['status'])) ? 1 : 0;           
            Email::create($requestData);          
            DB::Commit();
        
        return redirect()->route('admin.email')->with("status", "Your record has been saved successfully.");
    }

    /* Update a newly created resource in db.
    * @param  Request $request
    * @return Response
    */

    public function update(EmailRequest $request)
    {
        DB::beginTransaction();
        try{
            $email = Email::all();
            $email = Email::find($request->id);
            $requestData = $request->all();
            $requestData['status'] = (isset($requestData['status'])) ? 1 : 0;  
            if (empty($email)) {
                throw new Exception("Email not found");
            }
            $email->fill($requestData)->save();
            DB::commit();
        }
        catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('email.edit')->with("status", $exception->getMessage());
        }
        return redirect()->route('admin.email')->with("status", "Your record has been updated successfully.");
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
            $delete = Email::find($id);
            $delete->delete();
            DB::commit();
        } catch (Exception $exception){
            DB::rollBack();
            redirect()->route('admin.email.list')->with("status", $exception->getMessage());
        }
        return redirect()->back()->with("status", "Your email deleted successfully.");
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
            $emails = Email::sortable()->where('name', 'LIKE', '%' . $data . '%')->orWhere('subject', 'LIKE', '%' . $data . '%')->paginate(config('app.limit'))->withQueryString();
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('admin.email.list')->with("status", $exception->getMessage());
        }
        return view('backend.email.emaillist', compact('emails'));
    }

    /* change status a newly created resource in db.
    * @param  Request $request
    * @return Response
    */
    public function changeStatus(Request $request)
    {
        DB::beginTransaction();
        try {
            $email = Email::find($request->id);
            $email->status = !$email->status;
            $email->save();
            DB::commit();
        } catch (\Exception $exception){
            DB::rollBack();
            redirect()->route('admin.email')->with('success', 'Saved!'); 
        }
        return redirect()->route('admin.email')->with("status", "Status updated successfully.");
        
    }
}
