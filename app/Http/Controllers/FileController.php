<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Folder;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Models\Classification;
use Illuminate\Support\Facades\Storage;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use PDF;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Folder $folder)
    {
        // dd($folder->slug);
        $files = File::where('folder_id',$folder->id)->orderBy('updated_at','desc');

        if(request('search')){

            $files->where('document_name', 'like', '%' . request('search') . '%');
        }

        return view('mainpage.files.index',[
            
            "folders" => $folder,
            "files" => $files->paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Folder $folder)
    {
        return view('mainpage.files.create',[
            'slug' => $folder->slug,
            'locations' => Location::all(),
            'classifications' => Classification::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $folder = Folder::where('slug', $request->slug)->first();
        
        $validatedData = $request->validate([
            'document_name' => 'required|max:255',
            'reference_no' => 'required|max:255',
            'version' => 'required',
            'release_date' => 'required',
            'location_id'=> 'required',
            'classification_id'=>'required',
        ]);
        // dd($validatedData + ['folder_id' => $folder->id]);
        // dd($validatedData);

        if($request->file('formFileMultiple')){
            $filenameWithExt = $request->formFileMultiple->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->formFileMultiple->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // dd($fileNameToStore);
            // $validatedData['formFileMultiple'] = $request->file('formFileMultiple')->put('post-files');
            $toLocalStorage = $request->formFileMultiple->storeAs('public/post-files/', $fileNameToStore);
            $validatedData['formFileMultiple'] = '/storage/post-files/' . $fileNameToStore;
        }
        
        File::create($validatedData + [
            'folder_id' => $folder->id
        ]);
        return redirect('/mainpage/files/' . $folder->slug)->with('success', 'New file has been added!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        return view('mainpage.files.edit',[

            'file'=> $file,
            'locations' => Location::all(),
            'classifications' => Classification::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {
        $file = File::find($file->id);
        
        $validatedData = $request->validate([
            'document_name' => 'required|max:255',
            'reference_no' => 'required|max:255',
            'version' => 'required',
            'release_date' => 'required',
            'location_id'=> 'required',
            'classification_id'=>'required'
        ]);
        
        if($request->hasFile('formFileMultiple'))
        {
            $destination = '/storage/post-files/' . $file->formFileMultiple;
            if(File::exists($destination)){
                File::destroy($destination);
            }
            
            $filenameWithExt = $request -> formFileMultiple -> getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->formFileMultiple->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $toLocalStorage = $request->formFileMultiple->storeAs('public/post-files/', $fileNameToStore);
            $validatedData['formFileMultiple'] = '/storage/post-files/' . $fileNameToStore;
        }

        File::where('id', $file->id)->update($validatedData);
        return redirect('mainpage/files/' . $file->folder->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {   
        if($file->formFileMultiple){
            Storage::delete($file->formFileMultiple);
        }
        
        File::destroy($file->id);
        return redirect()->back()->withErrors($file)->withInput()->with('success', 'File has been deleted!');
    }

    public function checkSlugFile(Request $request)
    {
        $slugFile = SlugService::createSlug(File::class, 'slugFile', $request->document_name);
        return response()->json(['slugFile' => $slugFile]);
    }

}
