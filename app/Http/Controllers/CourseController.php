<?php

namespace App\Http\Controllers;

use App\Course;
use App\Categorie;
use App\Image;
use App\Http\Requests\StoreCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $category_list = Categorie::all('name', 'id');
        $courses = Course::latest()->paginate(10);
        return view('courses.index',compact(['courses','category_list']))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category_list = Categorie::all('name', 'id');
        return view('courses.create',compact('category_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCourse $request)
    {   $request->validate([ 'image'=>'required' ]);
        
        $image = $request->file('image');
        $filename = time().'.'.$image->getClientOriginalExtension();
        $c = new Course;
        $c->name = $request->name;
        $c->description = $request->description;
        $c->categorie_id = $request->categorie_id;
        $c->slug = $filename;
        $c->save();

        $ph = new Image;
        Storage::disk('images')->put($filename,file_get_contents($image));
        $ph->filename=$filename;
        $c->image()->save($ph);

        
        return redirect()->route('courses.index')
            ->with('success','Course created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        //$cat = Course::find($id)->category();
        //$cat = Categorie::find(1)->courses()->where('id', $id)->first();
        $course = Course::find($id);
        return view('courses.show',compact(['course']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category_list = Categorie::all('name', 'id');
        $course = Course::find($id);
        return view('courses.edit',compact('course','category_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCourse $request, $id)
    {
        
        $course = Course::find($id);
        $old_slug = $course->slug;
        if($request->hasFile('image')) {
            Storage::delete('public/images/'.$course->slug);
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $course->name = $request->name;
            $course->description = $request->description;
            $course->categorie_id = $request->categorie_id;
            $course->slug = $filename;
            $course->save();
            Storage::disk('images')->put($filename,file_get_contents($image));
            $ph =  Image::where('filename',$old_slug);
            $ph->filename = $filename;
            $course->image()->where('filename', $old_slug)
            ->update(['filename' => $filename]);
        
         }
        
        else {
            //$course->update($request->all());
            $course->name = $request->name;
            $course->description = $request->description;
            $course->categorie_id = $request->categorie_id;

            $course->save();

        }

        
        
        //$image->move(public_path('images'), $filename);
        

  

        
        return redirect()->route('courses.index')

                        ->with('success','Course updated successfully');
                        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
                
        $course = Course::find($id);
        $course->image()->delete();

        $course->delete();
        Storage::delete('public/images/'.$course->slug);

        return redirect()->route('courses.index')

                        ->with('success','Course deleted successfully');
    }
}
