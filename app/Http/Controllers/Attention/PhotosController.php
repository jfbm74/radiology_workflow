<?php

namespace App\Http\Controllers\Attention;

use App\Photos;
use App\Admission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PhotosController extends Controller
{
    public function store(Admission $admission){
        
        $this->validate(request(), [
            'photo' => 'image'
        ]);

        $photo = request()->file('photo')->store('public');
        
        Photos::create([
            'url' => Storage::url($photo),
            'admission_id' => $admission->id
        ]);
        
    }

    public function destroy(Photos $photo){

        $photo->delete(); 
        $photoPath = str_replace('storage', 'public', $photo->url);
        Storage::delete( $photoPath );

        return back()->with('flash', 'Foto eliminada');  
    }


    

    
}
