<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use Auth;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::paginate(6);
        return view('welcome', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'image'=>'required',
        ]);
        $images = $request->image;
        //loop through the image array

        foreach ($images as $image) {
            //upload the original image
            $imageName = time() . $image ->getClientOriginalName();
            //create folder imgs in your pojects public folder
            //set image destination/path
            $image -> move('imgs', $imageName);
            //create new instance
            $post = new image;
            $post -> user_id = Auth::user() ->id;
            $post -> image = 'imgs/'. $imageName;
            $post -> save();
        }
        return redirect('/')->with('success', 'Your image is successfully saved.');

      
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = Image::findOrFail($id);
        $image -> delete();

        return redirect('images')-> with('success', 'Deleted successfully');
    }
}
