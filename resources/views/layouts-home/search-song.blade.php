 <div class="spotify-playlists">
     <div class="description">
         <!-- Add any description or relevant information here -->
     </div>
     <div class="list">
         <div class="row">
             @if ($songs->isEmpty())
                 <p>No songs found.</p>
             @else
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
             @endif
         </div>
     </div>
 </div>


 <style>
     .spotify-playlists {
         padding: 20px 40px;
     }

     .spotify-playlists .description {
         display: block;
     }

     .spotify-playlists h2 {
         color: #ffffff;
         font-size: 22px;
         margin-bottom: 20px;
         display: inline-block;
     }

     .spotify-playlists h2:hover {
         cursor: pointer;
         text-decoration: underline;
         text-decoration-thickness: 2.2px;
     }

     .spotify-playlists>.description>p {
         display: inline-block;
         float: right;
         /* -webkit-tap-highlight-color: transparent; */
         font-size: 12px;
         font-weight: 600;
         color: #ccc;
         padding-top: 10px;
     }

     .spotify-playlists>.description>p>a {
         display: inline-block;
         float: right;
         /* -webkit-tap-highlight-color: transparent; */
         font-size: 12px;
         font-weight: 600;
         color: #ccc;
         padding-top: 10px;
         text-decoration: none;
         /* Gạch chân cho liên kết */
         cursor: pointer;
     }

     .spotify-playlists>.description>p:hover {
         cursor: pointer;
         text-decoration: underline;
         text-decoration-thickness: 1.4px;
         color: #dddddd;
     }

     .spotify-playlists .list {
         display: flex;
         gap: 20px;
         overflow: hidden;
     }

     .spotify-playlists .list .row {
         display: flex;
         flex-wrap: wrap;
         gap: 40px;
         overflow: hidden;


     }

     .spotify-playlists .list .item {
         min-width: 140px;
         width: 160px;
         padding: 15px;
         background-color: #181818;
         border-radius: 6px;
         cursor: pointer;
         transition: all ease 0.4s;
         min-height: 252px;
     }

     .spotify-playlists .list .item:hover {
         background-color: #252525;
     }

     .spotify-playlists .list .item img {
         width: 100%;
         border-radius: 6px;
         margin-bottom: 10px;
     }

     .artist-img {
         width: 100%;
         padding-top: 100%;
         /* Tạo chiều cao bằng với chiều rộng */
         position: relative;
         overflow: hidden;
         border-radius: 50%;
         margin-bottom: 10px;

     }

     .artist-img img {
         position: absolute;
         top: 0;
         left: 0;
         width: 100%;
         height: auto;
         object-fit: cover;
     }

     .spotify-playlists .list .item .play {
         position: relative;
     }

     .spotify-playlists .list .item .play .fa {
         position: absolute;
         right: 10px;
         top: -60px;
         padding: 18px;
         background-color: #1db954;
         border-radius: 100%;
         opacity: 0;
         transition: all ease 0.4s;
     }

     .spotify-playlists .list .item:hover .play .fa {
         opacity: 1;
         transform: translateY(-20px);
     }

     .spotify-playlists .list .item h4 {
         color: #ffffff;
         font-size: 14px;
         margin-bottom: 10px;
         white-space: nowrap;
         overflow: hidden;
         text-overflow: ellipsis;
     }

     .spotify-playlists .list .item p {
         color: #989898;
         font-size: 12px;
         line-height: 20px;
         font-weight: 600;
     }

     .spotify-playlists hr {
         margin: 70px 0px 0px;
         border-color: #636363;
     }
 </style>
