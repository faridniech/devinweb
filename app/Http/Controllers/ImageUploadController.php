<?php

namespace App\Http\Controllers;
use App\Image;
use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    public function image()
    {
        return view('imageupload');
    }

    public function imagePost(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $imageName = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('images'), $imageName);
        $image = new Image;
        $image->filename=$imageName;
        $image->imageable_type='aaa';
        $image->imageable_id=555;
        $image->save();
        return redirect()->back()
    		->with('success','Image has been Uploaded successfully.')
    		->with('image',$imageName);

    }
}
