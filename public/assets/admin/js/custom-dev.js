$(document).ready(function(){



$('.ask_delete').on('click', function(){

    var ask_type = $(this).data('ask-type');
  $('#modal-delete-'+ask_type).removeClass('d-none');

});


  //  MAP
var markerArr = new Array();




    var lat_b = $('#person_birth_lat_place').val();
    var lng_b = $('#person_birth_lng_place').val();

    var lat_d = $('#person_death_lat_place').val();
    var lng_d = $('#person_death_lng_place').val();


    var initLat = 41.66;
    var initLng = -4.72;

     if(lat_b != 'undefined' && lat_d == 'undefined') {

      var initLat =  lat_b;
      var initLng = lng_b;

    } else if(lat_b == 'undefined' && lat_d != 'undefined') {

      var initLat =  lat_d;
      var initLng = lng_d;

    }

    var map = L.map('map').setView([initLat, initLng],8);


      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
          maxZoom: 18
      }).addTo(map);




      if(lat_b != '') {
      var LamMarker =   L.marker([lat_b, lng_b]).addTo(map)
                  .bindPopup('Lugar de Nacimiento')
                  .openPopup();
        markerArr.push(LamMarker);
        map.addLayer(markerArr[0]);
      }

      if(lat_d != '') {
        var LamMarker =     L.marker([lat_d, lng_d]).addTo(map)
                    .bindPopup('Lugar de Fallecimiento')
                    .openPopup();

                    markerArr.push(LamMarker);
                    map.addLayer(markerArr[1]);
                  }



      $('.view-map').on('click', function(){


        $( '.view-map' ).each(function( index ) {
          $(this).data('activemap','false');
        });

        var  typecoor =  $(this).data('typecoor');
        var active =   $(this).data('activemap', 'true');
        var needMap = '';

        $('.cont_coord' ).each(function( index ) {
          $(this).css('opacity', '0.5');
        });

        $('#'+typecoor+'_lat').css('opacity', '1.0');
        $('#'+typecoor+'_lng').css('opacity', '1.0');

      });


      map.on('click', function(ev){

        var latlng = map.mouseEventToLatLng(ev.originalEvent);

        var namecoor = '';
        var text = '';
        var idLay = 0;


        $( '.view-map' ).each(function( index ) {
          if($(this).data('activemap') == 'true') {
            namecoor = $(this).data('typecoor');
          }
        });


        if(namecoor == 'birth') {
          text = 'Lugar de Nacimiento';

          if (typeof markerArr[0] != 'undefined') {
              map.removeLayer(markerArr[0]);
              var indice = markerArr.indexOf(markerArr[0]);
            //  markerArr.splice(indice, 1);
            }
        }


        if (namecoor == 'death') {
          text = 'Lugar de Fallecimiento';
          idLay = 1;

          if (typeof markerArr[1] != 'undefined') {
               map.removeLayer(markerArr[1]);
               var indice = markerArr.indexOf(markerArr[1]);
              // markerArr.splice(indice, 1);
            }
        }


        $('#person_'+namecoor+'_lat_place').val(latlng.lat);
        $('#person_'+namecoor+'_lng_place').val(latlng.lng);

        if(namecoor != '') {

          var LamMarker = L.marker([latlng.lat, latlng.lng]).addTo(map)
                            .bindPopup(text)
                            .openPopup();

                  map.removeLayer(markerArr[idLay]);
                  markerArr[idLay]=LamMarker;
                  map.addLayer(LamMarker);
        }

      });
      // END MAP


    // MODAL Delete
    $('.ask_delete').on('click', function(){

      var idperson = $(this).data('idperson');
      var typeAsk = $(this).data('ask-type');
      var iditem = $(this).data('iditem');
      var textModal = $(this).data('textmodal');
      var urlDummy = $(this).data('urldummy');


      urlCorrect = urlDummy.replace(/dummyidperson/g, idperson);
      urlCorrect = urlCorrect.replace(/dummyitem/g, iditem);
      $('#text-modal-'+typeAsk).html(textModal);
      $('#linkToDelete-'+typeAsk).attr('href', urlCorrect);
      $('#myModal-'+typeAsk).css('display', 'block');

    });

    $('.close-modal-delete').on('click', function(){
      var typeAsk = $(this).data('ask-type');
      $('#myModal-'+typeAsk).css('display', 'none');
    });

    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];



    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
    // END MODAL Delete

    $('.ckeditor').ckeditor();

});
