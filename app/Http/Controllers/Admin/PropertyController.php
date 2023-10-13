<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PropertyFormRequest;
use App\Models\Option;
use App\Models\Picture;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{

    public function __construct() {
        // Permet de vérifier les authorisation selon les ressources
        $this->authorizeResource(Property::class,'property');
    }

    public function index()
    {
        //dd(\Auth::user()->can('viewAny', Property::class));
        $properties = Property::orderBy('created_at','desc')->withTrashed()->paginate(15);
        return view('admin.properties.index', [
            /*
             * withTrashed() permet de récupérer les biens qui ont été soft deleted
             */
            'properties' => $properties
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $property=new Property();
        $property->fill([
            'surface' => 40,
            'rooms' => 3,
            'bedrooms' => 0,
            'floor' => 0,
            'city' => 'Montpellier',
            'postal_code' => 34000,
            'sold' => false
        ]);
        return view('admin.properties.form', [
            'property' => $property,
            'options' => Option::pluck('name','id')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PropertyFormRequest $request) {
        $property= Property::create($request->validated());
        if ($request->validated('pictures')!==null)
            $property->attachFiles($request->validated('pictures'));
        $property->options()->sync($request->validated('options'));
        $property->options()->sync($request->validated('options'));
        return to_route('admin.property.index')->with('success', 'Le bien a bien été créé');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {

        // Est-ce que l'utilisateur à le droit 'delete'
        //$this->authorize('delete',$property);

        // dd(\Auth::user()->can('delete', $property));
        return view('admin.properties.form', [
            'property' => $property,
            'options' => Option::pluck('name','id')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PropertyFormRequest $request, Property $property)
    {
        $property->update($request->validated());
        if ($request->validated('pictures')!==null)
            $property->attachFiles($request->validated('pictures'));
        $property->options()->sync($request->validated('options'));
        return to_route('admin.property.index')->with('success', 'Le bien a bien été modifié');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        Picture::destroy( $property->pictures()->pluck('id') );
        $property->delete();
        /*
         * Pour forcer la suppression en BDD
         * $property->forceDelete();
         */
        return to_route('admin.property.index')->with('success', 'Le bien a bien été supprimé');
    }

    public function restore(Property $property) {
        if ($property->isSoftDeleted()) {
            $property->restore();
        }
        return to_route('admin.property.index')->with('success', 'Le bien a bien été restauré');
    }
}
