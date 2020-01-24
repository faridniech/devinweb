<?php

namespace App\Http\Controllers;

use App\Categorie;
use App\Image;
use App\Course;

use App\Http\Requests\StoreCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categorie::latest()->paginate(10);
        return view('categories.index',compact('categories'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategory $request)
    {
        $request->validate([ 'image'=>'required' ]);
        $image = $request->file('image');
        $filename = time().'.'.$image->getClientOriginalExtension();
        $c = new Categorie;
        $c->name = $request->name;
        $c->slug = $filename;
        $c->save();

        Storage::disk('images')->put($filename,file_get_contents($image));
        $ph = new Image;
        $ph->filename=$filename;
        $c->image()->save($ph);
   

        return redirect()->route('categories.index')

                        ->with('success','Categorie created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categorie = Categorie::find($id);
        return view('categories.show',compact('categorie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categorie = Categorie::find($id);
        return view('categories.edit',compact('categorie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCategory $request, $id)
    {
        

  
        $categorie = Categorie::find($id);


        $old_slug = $categorie->slug;
        if($request->has('image')) {
            Storage::delete('public/images/'.$categorie->slug);
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $categorie->name = $request->name;
            $categorie->slug = $filename;
            $categorie->save();
            Storage::disk('images')->put($filename,file_get_contents($image));
            $ph =  Image::where('filename',$old_slug);
            $ph->filename = $filename;
            $categorie->image()->where('filename', $old_slug)
            ->update(['filename' => $filename]);
        
         }
        
        else {
            //$course->update($request->all());
            $categorie->name = $request->name;
            $categorie->save();

        }

        return redirect()->route('categories.index')

                        ->with('success','Categorie updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
                
        $categorie = Categorie::find($id);
        $course = Course::where('categorie_id',$id)->first();
        if($course){
            $course->image()->delete();
            Storage::delete('public/images/'.$course->slug);
            $categorie->courses()->delete();}
        Storage::delete('public/images/'.$categorie->slug);
        $categorie->image()->delete();
        $categorie->delete();


        

        return redirect()->route('categories.index')

                        ->with('success','Categorie deleted successfully');
    }
}
