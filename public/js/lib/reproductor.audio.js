// $(document).ready(function(){
//     getSongs();
// });

// var audio;
// var music;

// function getSongs(){
//     $.getJSON("js/musica.json",function(mjson){
//         music = mjson;
//         genList(music);
//     });
// }

// function genList(music){
//     $.each(music.songs,function(i,song){
//         $('#playlist').append('<li class="list-group-item" id="'+i+'">'+song.name+'</li>')
//     });
//     // $('#playlist').click(function(){
//     //     var selectedsong = $(this)attr('id');
//     // });
// }