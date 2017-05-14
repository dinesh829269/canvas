<?php

namespace App\Http\Controllers\servicecatalog;

use App\Http\Requests;
use Intervention\Image\Facades\Image as Image;
use Input;
use App\Http\Controllers\Controller;
use App\service_catelog;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Auth;
use Illuminate\Support\Facades\Redirect;


class service_catelogController extends Controller {

   /**
    * Display a listing of the resource.
    *
    * @return Response
    */
   public function index() {      
         $service_catelog = service_catelog::paginate(15);
         return view('service_catelog.index', compact('service_catelog'));
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
   public function create() {
      
         $service_catelog = service_catelog::all();
         $root_category = array('--Select--', 'Yes', 'No');         
         return view('service_catelog.create', compact('service_catelog', 'root_category'));
      
   }

   /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
   public function store(Request $request) {
      $this->validate($request, ['name' => 'required']);

         $service = service_catelog::where('name', $request->input('name'))->first();
         if (count($service) == 0) {
            $data = array(
                '_token' => $request->input('_token'),
                'name' => $request->input('name'),
                //'sequence' => $request->input('id'),
                'description' => $request->input('description')
            );

            if (Input::hasFile('image')) {
               $image = Input::file('image');

               $destinationPath = public_path('uploads/service_catalog/');
               $url_path = url('public/uploads/service_catalog/');
               $filename = $image->move($destinationPath, $image->getClientOriginalName());

               if (!is_dir($destinationPath . 'large/')) {
                  \ File::makeDirectory($destinationPath . 'large/', $mode = 0777, true, true);
               }
               if (!is_dir($destinationPath . 'medium/')) {
                  \File::makeDirectory($destinationPath . 'medium/', $mode = 0777, true, true);
               }
               if (!is_dir($destinationPath . 'thumbnail/')) {
                  \File::makeDirectory($destinationPath . 'thumbnail/', $mode = 0777, true, true);
               }
               $image_name = $image->getClientOriginalName();
               $checkimage = strtolower(substr($image_name, strrpos($image_name, '.') + 1));
               if ($checkimage == 'jpeg' || $checkimage == 'jpg' || $checkimage == 'png') {
                  //  return(1);
                  Image::make($filename->getRealPath())
                          ->fit('400', '400')
                          ->save($destinationPath . 'large/' . $image->getClientOriginalName())
                          ->fit('200', '200')
                          ->save($destinationPath . 'medium/' . $image->getClientOriginalName())
                          ->fit('60', '60')
                          ->save($destinationPath . 'thumbnail/' . $image->getClientOriginalName());

                  $data['image'] = $url_path . '/' . $image->getClientOriginalName();
               } else {
                  Session::flash('add_errors', 'Please upload image only');
                  return Redirect::back();
               }
            }

            //print_r($data);die;


            if (!empty($request->input('parent_id'))) {
               $data['parent_id'] = $request->input('parent_id');
            } else {
               $data['parent_id'] = NULL;
            }


            $service_catalog = service_catelog::create($data);

            Session::flash('flash_message', 'Service Catelog added!');
            return redirect('admin/service_catelog');
         } else {
            Session::flash('add_errors', 'Already exists with same name ');
            return Redirect::back();
         }      
   }

   /**
    * Display the specified resource.
    *
    * @param  int  $id
    *
    * @return Response
    */
   public function show($id) {
         $service_catelog = service_catelog::findOrFail($id);
         return view('service_catelog.show', compact('service_catelog'));      
   }

   

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    *
    * @return Response
    */
   public function edit($id) {
      
         $service_catelog = service_catelog::findOrFail($id);
         $servicecatalog_all = service_catelog::all();
         $root_category = array('--Select--', 'Yes', 'No');

         return view('service_catelog.edit', compact('service_catelog', 'servicecatalog_all', 'root_category'));
      
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    *
    * @return Response
    */
   public function update($id, Request $request) {
      $this->validate($request, ['name' => 'required']);
         $service = service_catelog::
                 where('name', $request->input('name'))
                 ->where('id', '!=', $id)
                 ->get();

         if (count($service) == 0) {

            $data = array(
                'name' => $request->input('name'),
                'description' => $request->input('description')
            );

            if (Input::hasFile('image')) {
               $image = Input::file('image');
               $destinationPath = public_path('uploads/service_catalog/');
               $url_path = url('public/uploads/service_catalog/');
               $filename = $image->move($destinationPath, $image->getClientOriginalName());

               if (!is_dir($destinationPath . 'large/')) {
                  \ File::makeDirectory($destinationPath . 'large/', $mode = 0777, true, true);
               }
               if (!is_dir($destinationPath . 'medium/')) {
                  \File::makeDirectory($destinationPath . 'medium/', $mode = 0777, true, true);
               }
               if (!is_dir($destinationPath . 'thumbnail/')) {
                  \File::makeDirectory($destinationPath . 'thumbnail/', $mode = 0777, true, true);
               }


               $image_name = $image->getClientOriginalName();
               $checkimage = strtolower(substr($image_name, strrpos($image_name, '.') + 1));
               if ($checkimage == 'jpeg' || $checkimage == 'jpg' || $checkimage == 'png') {
                  //  return(1);
                  Image::make($filename->getRealPath())
                          ->fit('400', '400')
                          ->save($destinationPath . 'large/' . $image->getClientOriginalName())
                          ->fit('200', '200')
                          ->save($destinationPath . 'medium/' . $image->getClientOriginalName())
                          ->fit('60', '60')
                          ->save($destinationPath . 'thumbnail/' . $image->getClientOriginalName());

                  $data['image'] = $url_path . '/' . $image->getClientOriginalName();
               } else {
                  Session::flash('edit_errors', 'Please upload image only');
                  return Redirect::back();
               }
            }


            if (!empty($request->input('parent_id'))) {
               $data['parent_id'] = $request->input('parent_id');
            } else {
               $data['parent_id'] = NULL;
            }

            $service_catelog = service_catelog::findOrFail($id);

            $service_catelog->update($data);
            Session::flash('flash_message', 'Service Catelog updated!');

            return redirect('admin/service_catelog');
         } else {
            Session::flash('edit_errors', 'Already exists with same name ');
            return Redirect::back();
         }      
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    *
    * @return Response
    */
   public function destroy($id) {
      if (Auth::user()->can('destroy.service_catalog')) {
         service_catelog::destroy($id);
         \App\service_category::where('service_catagory', $id)->delete();
         Session::flash('flash_message', 'Service Catelog deleted!');

         return redirect('admin/service_catelog');
      } else {
         return view('errors.notauthorise');
      }
   }
   
   /**
    * Search in Catalogue
    */
   public function search(Request $request){     
      $search = $_GET['search'];
      if(!empty($search)){      
         $searchWords = explode(' ', $search);
         $search_query = service_catelog::query();
         $search_query->orWhere('name', 'LIKE', '%'.$search.'%');         
         $search_result = $search_query->get();
         
         if(count($search_result)==0){
            $search_query = service_catelog::query();
            foreach($searchWords as $word){
               $search_query->orWhere('name', 'LIKE', '%'.$word.'%');
            }
            $search_result = $search_query->paginate(15);
         }
         $service_catelog = $search_result;
         return view('service_catelog.search', compact('service_catelog', 'search'));
      }
   }

   

}
