<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreSongRequest;
use App\Http\Requests\UpdateSongRequest;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Song::with('user')->latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|max:255'
        ]);

        $song = $request->user()->song()->create($fields);

        return ['reviewRating' => $song, 'user' => $song->user];
    }

    /**
     * Display the specified resource.
     */
    public function show(Song $song)
    {
        return ['reviewRating' => $song, 'user' => $song->user];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Song $song)
    {
        Gate::authorize('modify', $song);

        $fields = $request->validate([
            'name' => 'required|max:255'
        ]);

        $song->update($fields);

        return ['post' => $song, 'user' => $song->user];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Song $song)
    {
        Gate::authorize('modify', $song);

        $song->delete();

        return ['message' => 'The post was deleted'];
    }
}
