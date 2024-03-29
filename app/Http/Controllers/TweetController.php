<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TweetController extends Controller
{
    public function index()
    {
        $tweets = Tweet::simplePaginate(3); // Ändere die Anzahl der Tweets pro Seite nach Bedarf
        return response()->json($tweets);
    }

    public function show(Tweet $tweet)
    {
        return $tweet;
    }

    public function store(Request $request)
    {
        //hier kommen die Validierungsregeln
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'tweet' => 'required|string',
        ]);

         // Überprüfe, ob die Validierung fehlgeschlagen ist
         if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        //Hier erstelle ich einen neuen Tweet mit Titel- und Textwerten
        $tweet = Tweet::create([
            'firstname'=>'wojtek',
            'lastname'=>'strzyzowski',
            'title' => $request->title,
            'tweet'=> $request->tweet
        ]);

        //Tweet wird als Objekt zurück gegenben ohne eine neue Anfrage zu schicken
        return response()->json(['message' => 'Tweet created successfully', 'tweet' => $tweet], 201);
    }

    public function update(Request $request, Tweet $tweet)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'tweet' => 'required',
        ], [
            'title.required' => 'The title field is required.',
            'tweet.required' => 'The tweet field is required.',
        ]);

        $tweet->update($validatedData);

        return response()->json(['message' => 'Tweet updated successfully', 'tweet' => $tweet]);
    }

    public function destroy(Tweet $tweet)
    {
        $tweet->delete();

        return response()->json(['message' => 'Tweet deleted successfully']);
    }
}
