@extends('layouts-home.master-genre')

@section('content')
    <div class="spotify-playlists">
        <div class="description">
            <h2>{{ $genre->Name }}</h2>
        </div>
        <div class="list">
            <div class="row">
                @foreach ($songs as $song)
                    <div class="item play-item" onclick="updatePlayer(event)">
                        <img src="{{ asset('song_images/' . $song->Song_IMG) }}" />
                        <div class="play">
                            <span class="fa fa-play"></span>
                        </div>
                        <h4>{{ $song->Name }}</h4>
                        @if ($song->artists->isNotEmpty())
                            <p>{{ Str::limit(implode(', ', $song->artists->pluck('Name')->toArray()), 50) }}</p>
                        @endif
                        <audio id="audio-player" controls style="display: none;">
                            <source src="{{ asset('song_audio/' . $song->Song_Audio) }}" type="audio/mpeg">
                        </audio>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
