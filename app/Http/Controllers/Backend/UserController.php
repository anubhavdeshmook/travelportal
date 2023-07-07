<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserEditRequest;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(User $user)
    {  
       
        DB::beginTransaction();
        $users = [];
        try {
            $users = User::sortable()->latest()->paginate(config('app.limit'))->withQueryString();
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('admin.user')->with("status", $exception->getMessage());

        }
        return view('backend.user.list', compact('users'));
    }

    /**
     * View listing of the resource.
     * @return Response
     */
    public function view(User $user)
    {
        DB::beginTransaction();
        try {
            $user = User::find($user->id);
            DB::commit();
        } catch (ModelNotFoundException $exception) {
            DB::rollBack();
            redirect()->route('user.view')->with("status", $exception->getMessage());
        }
        return view('backend.user.show', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        DB::beginTransaction();
        try {
            $user = User::all();
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('admin.user.create')->with("status", $exception->getMessage());
        }
        return view('backend.user.create',compact('user'));
    }
    
    /**
     * Edit the form for creating a resource.
     * @return Response
     */
    public function edit(User $user)
    {
        DB::beginTransaction();
        try {
            $user = User::find($user->id);
            DB::commit();
            if (empty($user)) {
                throw new Exception("User not found");
            }
        } catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('admin.user.create')->with("status", $exception->getMessage());
    
        }
        return view('backend.user.edit', compact('user'));
    }

    /* Store a newly created resource in db.
    * @param  Request $request
    * @return Response
    */
    public function save(UserRequest $request)
   {
    DB::beginTransaction();
        try{
            $requestData = $request->all();
            $requestData['status'] = (isset($requestData['status'])) ? 1 : 0;   
            $requestData['password'] = Hash::make($requestData['password']);    
            $requestData['email'] = Str::lower($requestData['email']); 
            
            User::create($requestData);          
            DB::commit();
        }
        catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('admin.user.create')->with("status", $exception->getMessage());
        }
        
        return redirect()->route('admin.user')->with("status", "Your record has been saved successfully.");
    }

    /* Update a newly created resource in db.
    * @param  Request $request
    * @return Response
    */

    public function update(UserEditRequest $request)
    {
        DB::beginTransaction();
       
        try{
            $user = User::all();
        $user = User::find($request->id);
        $requestData = $request->all();
        $requestData['status'] = (isset($requestData['status'])) ? 1 : 0;
        $requestData['email'] = Str::lower($requestData['email']); 
        if(!empty($requestData['password'])) {
        
            $requestData['password'] = Hash::make($requestData['password']);
        } 
        
        if (empty($user)) {
            throw new Exception("User not found");
        }
        $user->fill($requestData)->save();
        DB::commit();
        }
        catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('admin.user')->with("status", $exception->getMessage());
        }
        return redirect()->route('admin.user')->with("status", "Your record has been updated successfully.");
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
            $delete = User::find($id);
            $delete->delete();
            DB::commit();
        } catch (Exception $exception){
            DB::rollBack();
            redirect()->route('admin.user.list')->with("status", $exception->getMessage());
        }
        return redirect()->back()->with("status", "User deleted successfully.");
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
            $users = User::sortable()->where('name', 'LIKE', '%' . $data . '%')->orWhere('email', 'LIKE', '%' . $data . '%')->paginate(config('app.limit'))->withQueryString();
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('user.list')->with("status", $exception->getMessage());
        }
        return view('backend.user.list', compact('users'));
    }

    /* change status a newly created resource in db.
    * @param  Request $request
    * @return Response
    */
    public function changeStatus(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = User::find($request->id);
            $user->status = !$user->status;
            $user->save();
            DB::commit();
        } catch (\Exception $exception){
            DB::rollBack();
            redirect()->route('admin.user')->with('success', 'Saved!'); 
        }
        return redirect()->route('admin.user')->with("status", "Status updated successfully.");
        
    }
}
