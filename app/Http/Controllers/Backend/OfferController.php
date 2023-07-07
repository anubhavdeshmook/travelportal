<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\Email;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\OfferRequest;
use App\Models\Destination;
use Exception;
use Illuminate\Support\Facades\DB;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Email $email)
    {          
        DB::beginTransaction(); 
       
        try {
            $offers = Offer::with('destinations')->sortable()->latest()->paginate(config('app.limit'))->withQueryString();
       
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('admin.offers')->with("status", $exception->getMessage());

        }
        return view('backend.offer.list',compact('offers'));
    }

    /**
     * View listing of the resource.
     * @return Response
     */
    public function view(Offer $offer,$id)
    {
        DB::beginTransaction();
        try {
            $offer = Offer::with('destinations')->find($id);
            DB::commit();
        } catch (ModelNotFoundException $exception) {
            DB::rollBack();
            redirect()->route('offers.view')->with("status", $exception->getMessage());
        }
        return view('backend.offer.view', compact('offer'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
     
        DB::beginTransaction();
        try {
            $offer = Offer::with('destinations')->get();
            $destinations = Destination::get();
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('admin.offers.create')->with("status", $exception->getMessage());
        }
     
        return view('backend.offer.create',compact('offer','destinations'));
    }
    
    /**
     * Edit the form for creating a resource.
     * @return Response
     */
    public function edit(Offer $offer,$id)
    {
        DB::beginTransaction();
        try {
            $offer = Offer::find($id);
            $destinations = Destination::get();
            DB::commit();
           
        } catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('admin.offers')->with("status", $exception->getMessage());
    
        }
        return view('backend.offer.edit', compact('offer','destinations'));
    }

    /* Store a newly created resource in db.
    * @param  Request $request
    * @return Response
    */
    public function save(OfferRequest $request)
   {
       
    DB::beginTransaction();  
    $requestData = $request->all();
            $requestData['status'] = (isset($requestData['status'])) ? 1 : 0;           
            Offer::create($requestData);          
            DB::Commit();
        try{    
            
         
        }
        catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('admin.offers.create')->with("status", $exception->getMessage());
        }
        
        return redirect()->route('admin.offers')->with("status", "Your record has been saved successfully.");
    }

    /* Update a newly created resource in db.
    * @param  Request $request
    * @return Response
    */

    public function update(OfferRequest $request)
    {
        DB::beginTransaction();
      
        try{
            $offer = Offer::all();
            $offer = Offer::find($request->id);
            $requestData = $request->all();
            $requestData['status'] = (isset($requestData['status'])) ? 1 : 0;  
            if (empty($offer)) {
                throw new Exception("Email not found");
            }
            $offer->fill($requestData)->save();
            DB::commit();
        }
        catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('admin.offers')->with("status", $exception->getMessage());
        }
        return redirect()->route('admin.offers')->with("status", "Your record has been updated successfully.");
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
            $delete = Offer::find($id);
            $delete->delete();
            DB::commit();
        } catch (Exception $exception){
            DB::rollBack();
            redirect()->route('admin.offers')->with("status", $exception->getMessage());
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
            $offers = Offer::sortable()->where('name', 'LIKE', '%' . $data . '%')->paginate(config('app.limit'))->withQueryString();
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('admin.offers.list')->with("status", $exception->getMessage());
        }
        return view('backend.offer.list', compact('offers'));
    }

    /* change status a newly created resource in db.
    * @param  Request $request
    * @return Response
    */
    public function changeStatus(Request $request)
    {
        DB::beginTransaction();
        try {
            $offer = Offer::find($request->id);
            $offer->status = !$offer->status;
            $offer->save();
            DB::commit();
        } catch (\Exception $exception){
            DB::rollBack();
            redirect()->route('admin.offers')->with('success', 'Saved!'); 
        }
        return redirect()->route('admin.offers')->with("status", "Status updated successfully.");
        
    }
}
