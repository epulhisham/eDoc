<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Folder;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class FolderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('mainpage.folders.index',[
            
            'folders' => Folder::where('user_id',auth()->user()->id)->orderBy('updated_at','desc')->get(),
            'files' => File::all()
            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mainpage.folders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([

            'name' => 'required|max:255',
            'slug' => 'required'
        ]);

        $validatedData['user_id'] = auth()->user()->id;
        
        Folder::create($validatedData);

        return redirect('/mainpage/folders')->with('success', 'New folder has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function show(Folder $folder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function edit(Folder $folder)
    {
        return view('mainpage.folders.edit',[

            'folder'=> $folder
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Folder $folder)
    {
        $rules = [

            'name' => 'required|max:255',

        ];

        if($request->slug != $folder->slug){

            $rules['slug'] = 'required|unique:folders';
        }

        $validatedData = $request->validate($rules);

        Folder::where('id', $folder->id)->update($validatedData);

        return redirect('/mainpage/folders')->with('success', 'Folder has been edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function destroy(Folder $folder)
    {
        Folder::destroy($folder->id);
        return redirect('/mainpage/folders')->with('success', 'Folder has been deleted!');
    }
    
    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Folder::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
