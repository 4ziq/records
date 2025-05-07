<?php

namespace App\Policies;

use App\Models\Song;
use App\Models\Artist;
use Illuminate\Auth\Access\Response;

class SongPolicy
{
    public function modify(Artist $artist, Song $song): Response
    {
        return $artist->id === $song->artist_id 
                ? Response::allow() 
                : Response::deny();
    }
}
