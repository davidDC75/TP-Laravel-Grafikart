<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Picture;
use Illuminate\Http\Request;

class PictureController extends Controller
{

    /*
    public function __construct() {
        // Permet de vérifier les authorisation selon les ressources
        $this->authorizeResource(Picture::class,'picture');
    }
    */

    public function destroy(Picture $picture): string {
        $picture->delete();
        return '';
    }
}
