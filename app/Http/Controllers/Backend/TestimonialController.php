<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\EmailRequest;
use Exception;
use Illuminate\Support\Facades\DB;
use DataTables;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Testimonial $testimonial)
    {          
        DB::beginTransaction(); 
        $testimonials = [];       
        try {
            $testimonials = Testimonial::orderBy('order','ASC')->sortable()->latest()->paginate(config('app.limit'))->withQueryString();
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('admin.testimonials')->with("status", $exception->getMessage());

        }
        return view('backend.testimonials.list',compact('testimonials'));
    }

    /**
     * View listing of the resource.
     * @return Response
     */
    public function view(Testimonial $testimonials,$id)
    {
        DB::beginTransaction();
        try {
            $testimonials = Testimonial::find($id);
    
            DB::commit();
        } catch (ModelNotFoundException $exception) {
            DB::rollBack();
            redirect()->route('testimonials.view')->with("status", $exception->getMessage());
        }
        return view('backend.testimonials.view', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        DB::beginTransaction();
        try {
            $testimonials = Testimonial::all();
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('admin.testimonials.create')->with("status", $exception->getMessage());
        }
        return view('backend.testimonials.create',compact('testimonials'));
    }
    
    /**
     * Edit the form for creating a resource.
     * @return Response
     */
    public function edit(Testimonial $testimonials, $id)
    {
        DB::beginTransaction();
        try {
            $testimonials = Testimonial::find($id);
            DB::commit();
            if (empty($testimonials)) {
                throw new Exception("testimonials not found");
            }
        } catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('admin.testimonials')->with("status", $exception->getMessage());
    
        }
        return view('backend.testimonials.edit', compact('testimonials'));
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
            Testimonial::create($requestData);          
            DB::Commit();
         
        }
        catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('admin.testimonials.create')->with("status", $exception->getMessage());
        }
        
        return redirect()->route('admin.testimonials')->with("status", "Your record has been saved successfully.");
    }

    /* Update a newly created resource in db.
    * @param  Request $request
    * @return Response
    */

    public function update(Request $request)
    {
        
        DB::beginTransaction();
        try{
            $testimonial = Testimonial::all();
            $testimonials = Testimonial::find($request->id);
            $requestData = $request->all();
            $requestData['status'] = (isset($requestData['status'])) ? 1 : 0;  
            if (empty($testimonials)) {
                throw new Exception("testimonial not found");
            }
            $testimonials->fill($requestData)->save();
            DB::commit();
        }
        catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('admin.testimonials')->with("status", $exception->getMessage());
        }
        return redirect()->route('admin.testimonials')->with("status", "Your record has been updated successfully.");
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
            $delete = Testimonial::find($id);
            $delete->delete();
            DB::commit();
        } catch (Exception $exception){
            DB::rollBack();
            redirect()->route('admin.testimonials.list')->with("status", $exception->getMessage());
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
            $testimonials = Testimonial::sortable()->where('name', 'LIKE', '%' . $data . '%')->orWhere('subject', 'LIKE', '%' . $data . '%')->paginate(config('app.limit'))->withQueryString();
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('admin.testimonials.list')->with("status", $exception->getMessage());
        }
        return view('backend.testimonials.list', compact('testimonials'));
    }

    /* change status a newly created resource in db.
    * @param  Request $request
    * @return Response
    */
    public function changeStatus(Request $request)
    {
        DB::beginTransaction();
        try {
            $testimonials = Testimonial::find($request->id);
            $testimonials->status = !$testimonials->status;
            $testimonials->save();
            DB::commit();
        } catch (\Exception $exception){
            DB::rollBack();
            redirect()->route('admin.testimonials')->with('success', 'Saved!'); 
        }
        return redirect()->route('admin.testimonials')->with("status", "Status updated successfully.");
        
    }

    public function shortupdate(Request $request){
     
        $testimonials = Testimonial::get();

        foreach ($testimonials as $testimonial) {
            foreach ($request->order as $order) {
                if ($order['id'] == $testimonial->id) {
                  
                        $testimonialss = Testimonial::find($testimonial->id);
                        $testimonialss->order = $order['position'];
                        $testimonialss->save();

                    // $store->update(['order' => $order['position']]);
                    // $store->save();
                }
            }
        }
        
        return response()->json([
            'success' => true,
         
          ]);
    }
}
