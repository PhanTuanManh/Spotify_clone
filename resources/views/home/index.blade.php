@extends('layouts-home.master')


@section('content')
    <div class="spotify-playlists">
        <div class="description">
            <h2>Recommended for today</h2>
        </div>
        <div class="list">
            @foreach (\App\Models\Songs::inRandomOrder()->take(6)->get() as $song)
                <div class="item play-item" onclick="updatePlayer(event)">
                    <img src="{{ asset('song_images/' . $song->Song_IMG) }}" />
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>{{ $song->Name }}</h4>
                    @if ($song->artists->isNotEmpty())
                        <p>{{ $song->artists->first()->Name }}</p>
                    @endif
                    <audio id="audio-player" controls style="display: none;">
                        <source src="{{ asset('song_audio/' . $song->Song_Audio) }}" type="audio/mpeg">
                    </audio>
                </div>
            @endforeach
        </div>
    </div>



    @foreach ($genres as $genre)
        <div class="spotify-playlists">
            <div class="description">
                <h2>{{ $genre->Name }}</h2>
                <p><a href="{{ route('genre.show', ['name' => $genre->Name]) }}">Show all</a></p>
            </div>
            <div class="list">
                @foreach ($genre->songs()->inRandomOrder()->take(6)->get() as $song)
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
    @endforeach


    <div class="spotify-playlists">
        <div class="description">
            <h2>Suggested artists</h2>
            <p>Show all</p>
        </div>
        <div class="list">
            @foreach ($artists as $artist)
                <div class="item" onclick="playArtistSong({{ $artist->Artist_id }})">
                    <div class="artist-img">
                        <img src="{{ asset('avatars/' . $artist->Avatar) }}" />
                    </div>
                    <div class="play">
                        <span class="fa fa-play"></span>
                    </div>
                    <h4>{{ $artist->Name }}</h4>
                    <p>Artist</p>
                </div>
            @endforeach
        </div>
    </div>
@endsection
