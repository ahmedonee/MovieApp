<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Image;
use Illuminate\Support\Facades\Input;

class setsController extends Controller
{
    //
         public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $sets = DB::table('sets')->get();
        return view('sets', ['sets' => $sets]);
    }
    public function store(Request $request) {
   

        $set           = new \App\Set;
        $set->title     = $request->input('title');
        $set->description    = $request->input('description');
        $set->status     = 0;
        
        if (Input::hasFile('img')) {
            $image    = Input::file('img');
            $filename = time().'.'.$image->getClientOriginalExtension();
            //$path     = ('public/profilepics/');
            $path = public_path('imgs/'.$filename);
            //$image->move($path, $filename);
            Image::make($image->getRealPath())->resize(120, 120)->save($path);

            //$user->image = $path.$filename;
            $set->img = $filename;
        }
        $set->save();
        return redirect()->back()->withSuccess('New Set created');
    }

    public function edit($id) {
        $set       = \App\Set::find($id);
        return view('editset', compact('set'));
    }

    public function update($id, Request $request) {
        $user           = \App\Set::find($id);
        $user->title     = $request->input('title');
        $user->description    = $request->input('description');
        

        if (Input::hasFile('img')) {
            $img    = Input::file('img');
            $filename = time().'.'.$img->getClientOriginalExtension();
            $path     = public_path('imgs/'.$filename);
            Image::make($img->getRealPath())->resize(120, 120)->save($path);
            $user->img = $filename;
        }
        $user->save();
        return redirect('/sets')->withSuccess('User Edited');
    }

    public function delete($id) {
        $set = \App\Set::find($id);
        $set->delete();
        $imgpath = public_path('public/imgs/'.$set->img);
        File::delete($imgpath);
        return redirect()->back()->withSuccess('Set deleted');
    }
    public function enable($id)
    {
         $set = \App\Set::find($id);
         $set->status=1;
         $set->save();
         return redirect()->back()->withSuccess('Set Enabled');

    }
     public function disable($id)
    {
         $set = \App\Set::find($id);
         $set->status=0;
         $set->save();
         return redirect()->back()->withSuccess('Set Disabled');

    }

}
