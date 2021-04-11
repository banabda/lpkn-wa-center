<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image as Img;

class ImageController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function resizeImage()
    {
        return view('resizeImage');
    }
  
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4192',
        ]);
  
        $image = $request->file('image');
        $input['imagename'] = time().'.'.$image->extension();
        $destinationPath = storage_path().'/app/public/upload/sendMedia/'.$input['imagename'];
        // $destinationPath = public_path('thumbnail/'). $input['imagename'];

        $img = Img::make($image->path());
        $img->resize(500, 500, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath);
        
        // $destinationPath = public_path('/images');
        // $image->move($destinationPath, $input['imagename']);
    
        $url = '/storage/upload/sendMedia/'.$input['imagename'];
        
        $imageDB = Image::create([
            'url' => $url
        ]);
   
        return $url;
    }
}
