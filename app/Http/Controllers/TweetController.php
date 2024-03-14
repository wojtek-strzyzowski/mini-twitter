<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    public function index()
    {
        return Tweet::all();
    }

    public function show(Tweet $tweet)
    {
        return $tweet;
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'tweet' => 'required',
        ], [
            'title.required' => 'The title field is required.',
            'tweet.required' => 'The tweet field is required.',
        ]);

        $tweet = Tweet::create($validatedData);

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
