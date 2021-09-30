<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as ImageIn;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //We retrieve all the images entries that are in the DB

        $images = Image::get();

        //We pass all the data in json format to use it with Vue

        return response()
            ->json(['images' => $images]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //We create the validation for the request

        $request->validate([
            'description' => 'string|max:50',
            'resolution' => 'string|max:12',
            'image' => 'required|mimes:jpg,jpeg,png|max:2048',
        ]);

        //We assign image variable

        $image = $request->file('image');
        $filename = time() . '.' . $image->getClientOriginalExtension();

        //Depending of the resolution choice of the user, we proceed to resize the image according to that choice
        //And then we save the resize image to our images folder.
        if ($request->resolution === "200x200") {
            ImageIn::make($image)->resize(200, 200)->save(public_path('images/uploads/' . $filename));
        } elseif ($request->resolution === "300x300") {
            ImageIn::make($image)->resize(300, 300)->save(public_path('images/uploads/' . $filename));
        } elseif ($request->resolution === "400x400") {
            ImageIn::make($image)->resize(400, 400)->save(public_path('images/uploads/' . $filename));
        }

        //Finally we create the instance of Image where we assign all the compiled data

        $image = Image::create([
            'user_id' => Auth::id(),
            'description' => $request->description,
            'resolution' => $request->resolution,
            'image' => $filename,
        ]);
    }
}
