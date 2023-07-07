<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DestinationPage;
use App\Models\Country;
use App\Models\Destination;
use App\Models\DestinationImage;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Http\Requests\DestinationPageRequest;
use App\Http\Requests\DestinationImageRequest;
use Exception;
use Illuminate\Support\Facades\DB;



class DestinationPageController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(DestinationPage $destinationpage)
    {  
       
        DB::beginTransaction();   
        try {
            $destinationpages = DestinationPage::with('Country')->sortable()->latest()->paginate(config('app.limit'))->withQueryString();

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('admin.destination.page')->with("status", $exception->getMessage());

        }
        return view('backend.destinationpages.list', compact('destinationpages'));
    }

    /**
     * View listing of the resource.
     * @return Response
     */
    public function view(Destination $destination,$id)
    {
        DB::beginTransaction();
        try {
            $destinationpage = DestinationPage::with('Country')->find($id);
            DB::commit();
        } catch (ModelNotFoundException $exception) {
            DB::rollBack();
            redirect()->route('destination.page.view')->with("status", $exception->getMessage());
        }
        return view('backend.destinationpages.view', compact('destinationpage'));
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
            redirect()->route('admin.destination.page.create')->with("status", $exception->getMessage());
        }
        return view('backend.destinationpages.create',compact('country'));
    }
    
    /**
     * Edit the form for creating a resource.
     * @return Response
     */
    public function edit(DestinationPage $destionationpage,$id)
    {
        
        DB::beginTransaction();
        try {
            $destinationpage = DestinationPage::find($id);
            $country = Country::get();
            $detinationimages = DestinationImage::where('destination',$id)->get();

            DB::commit();
            if (empty($destinationpage)) {
                throw new Exception("Destination Page not found");
            }
        } catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('admin.destination.page.create')->with("status", $exception->getMessage());
    
        }
        return view('backend.destinationpages.edit', compact('destinationpage','country','detinationimages'));
    }

    /* Store a newly created resource in db.
    * @param  Request $request
    * @return Response
    */
    public function save(DestinationPageRequest $request)
   {
       DB::beginTransaction();
 
        try{  
            $requestData = $request->all();
            $requestData['status'] = (isset($requestData['status'])) ? 1 : 0;  
            $destination= DestinationPage::create($requestData);          
            DB::commit();          
            
        }
        catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('admin.destination.page.create')->with("status", $exception->getMessage());
        }
        
        return redirect()->route('admin.destination.page.edit',[$destination->id, "#image-tab"])->with("status", "Your record has been saved successfully.");
    }

    /* Update a newly created resource in db.
    * @param  Request $request
    * @return Response
    */

    public function update(DestinationPageRequest $request)
    {      

        DB::beginTransaction();
        $destionationpages = DestinationPage::all();
        $destionationpage = DestinationPage::find($request->id);
        $requestData = $request->all();
        $requestData['status'] = (isset($requestData['status'])) ? 1 : 0;  
        if (empty($destionationpage)) {
            throw new Exception("Destionation page not found");
        }
        $destionationpage->fill($requestData)->save();
        DB::commit();
        try{
          
        }
        catch (Exception $exception) {
            DB::rollBack();

            redirect()->route('admin.destination.page.edit',$request->id)->with("status", $exception->getMessage());
        }
        return redirect()->route('admin.destination.page')->with("status", "Your record has been updated successfully.");
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
            $delete = DestinationPage::find($id);
            $delete->delete();
            DB::commit();
        } catch (Exception $exception){
            DB::rollBack();
            redirect()->route('admin.destination.page.list')->with("status", $exception->getMessage());
        }
        return redirect()->back()->with("status", "Destination Page deleted successfully.");
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
            $destinationpages = DestinationPage::sortable()->where('name', 'LIKE', '%' . $data . '%')->paginate(config('app.limit'))->withQueryString();
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('admin.destination.page')->with("status", $exception->getMessage());
        }
        return view('backend.destinationpages.list', compact('destinationpages'));
    }

    /* change status a newly created resource in db.
    * @param  Request $request
    * @return Response
    */
    public function changeStatus(Request $request)
    {
        DB::beginTransaction();
        try {
            $destionationpage = DestinationPage::find($request->id);
            $destionationpage->status = !$destionationpage->status;
            $destionationpage->save();
            DB::commit();
        } catch (\Exception $exception){
            DB::rollBack();
            redirect()->route('admin.destination.page')->with('success', 'Saved!'); 
        }
        return redirect()->route('admin.destination.page')->with("status", "Status updated successfully.");
        
    }

    public function imagesupdate(DestinationImageRequest $request){
        
        $finddestintion = DestinationImage::where('id',$request->destination_id)->first();

        if($finddestintion){
            $deleteimages = DestinationImage::where('id',$request->destination_id)->delete();
            if($request->hasfile('image'))
            {
   
               foreach($request->file('image') as $image)
               {   
                   $form= new DestinationImage();
                   $form->destination= $request->destination_id;
                   $name=$image->getClientOriginalName();
                   $image->move(public_path().'/public/backend/destination', $name);  
                   $data = $name;  
                   $form->image=$data;
                   $form->save();                
               }
            } 

        }else{
            if($request->hasfile('image'))
            {
   
               foreach($request->file('image') as $image)
               {   
                   $form= new DestinationImage();
                   $form->destination= $request->destination_id;
                   $name=$image->getClientOriginalName();
                   $image->move(public_path().'/public/backend/destination', $name);  
                   $data = $name;  
                   $form->image=$data;
                   $form->save();                
               }
            } 

        }
        
         
       

        return redirect()->route('admin.destination.page')->with("status", "Record updated successfully.");

    }

    public function imagesdelete(Request $request){
        DB::beginTransaction();
        $id = $request->id;
        try {
            $delete = DestinationImage::find($id);
            $delete->delete();
            DB::commit();
        } catch (Exception $exception){
            DB::rollBack();
            return redirect()->back()->with("status", $exception->getMessage());
        }
        return redirect()->back()->with("status", "Destination Image Deleted Successfully.");

    }
}
