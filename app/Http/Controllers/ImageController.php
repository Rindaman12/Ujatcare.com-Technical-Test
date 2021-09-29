<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::get();

        return response()
            ->json(['images' => $images]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //The images is created

        $request->validate([
    'description' => 'string|max:40',
    'resolution' => 'string|max:12',
    'image' => 'required|mimes:jpg,jpeg,png|max:2048',
]);

        $user = Auth::user();

        //If the user has less than 12 images, He can add a new one

        if (count($user->images) < 12) {
            $directory = str_replace("\\", "/", public_path())."/images/uploads/$user->user-uploads";
    
            //if the directory is not create, we proceed to generate it
            if (!File::exists($directory)) {
                File::makeDirectory($directory);
            }

            $image = $request->file('image');

            $file_name = time() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($image);
            $img->save("$directory/$file_name");

            

            $image = image::create([
                'user_id' => Auth::id(),
                'description' => $request->description,
                'resolution' => $request->resolution,
                'image' => $file_name,
           
        ]);
            
            return $image;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        //
    }
}
