<?php

namespace App\Http\Controllers;

use App\Events\ContactRequestEvent;
use App\Http\Requests\PropertyContactRequest;
use App\Http\Requests\SearchPropertiesRequest;
use App\Mail\PropertyContactMail;
use App\Models\User;
use App\Notifications\ContactRequestNotification;
use Illuminate\Http\Request;
use App\Models\Property;
use Illuminate\Support\Facades\Mail;

class PropertyController extends Controller
{
    public function index(SearchPropertiesRequest $request) {
        // Le with permet de préloader les pictures et les options en minimisant le nombre de requête SQL
        $query=Property::query()->with('pictures')->with('options')->orderBy('created_at','desc');

        if ($price = $request->validated('price')) {
            $query=$query->where('price','<=', $price);
        }

        if ($surface = $request->validated('surface')) {
            $query=$query->where('surface','>=', $surface);
        }

        if ($rooms = $request->validated('rooms')) {
            $query=$query->where('rooms','>=', $rooms);
        }

        if ($title = $request->validated('title')) {
            $query=$query->where('title','like','%'.$title.'%');
        }
        return view('property.index', [
            'properties' => $query->paginate(10),
            'input' => $request->validated()
        ]);
    }

    public function show(string $slug, Property $property) {
        // Pour récupérer la notification
        /** @var User $user */
        $user = User::find(20);
        // Marque comme lu
        //dd($user->unreadNotifications[0]->markAsRead());
        // On peut aussi le faire d'un coup pour toutes les notifications non lues
        //dd($user->unreadNotifications->markAsRead());
        //dd($user->unreadNotifications);
        //dd($user->notifications);
        $expectedSlug=$property->getSlug();
        if ($slug !== $expectedSlug) {
            return to_route('property.show', ['slug' => $expectedSlug,'property' => $property]);
        }

        return view('property.show', [
            'property' => $property
        ]);
    }

    public function contact(Property $property,PropertyContactRequest $request) {

        // Pour déclencher l'événement
        //ContactRequestEvent::dispatch($property,$request->validated());
        //event(new ContactRequestEvent($property, $request->validated()));

        // On utilise dans ce cas, les notifications
        /** @var User $user */
        $user = User::find(20);
        $user->notify(new ContactRequestNotification($property, $request->validated()));
        return back()->with('success','Votre demande de contact a bien été envoyé.');
    }
}
