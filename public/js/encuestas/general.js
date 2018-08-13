jQuery(document).ready(function($) {
  
  console.log("archivo anexo de scripts");

  $('a.anchorclass').click(yourfunction);
  
  function yourfunction(){
    console.log("a, id: " + $(this).attr('id') );
    openTab($(this).attr('id'));
    //openTab($(this).hide());
  }

  function openTab(tab) {
    console.log("tab: " + tab );
    //$('.tabcontent').css('style', 'display', 'none');
    
    $( ".tabcontent" ).each(function( index, element ) {
      // element == this
      $( element ).css( "display", "none" );
      /*if ( $( this ).is( "#stop" ) ) {
        $( "span" ).text( "Stopped at div index #" + index );
        return false;
      }*/
    });
    
    console.log('mostramos solo el elemento seleccionado, id : '+ tab);
    $( "#tab"+tab).css( "display", "block" );
    //$("#tab"+tab).css("color", "green");
   /* $(".tabcontent").each(function(){
      
      console.log("element " + $(this).find(".tabcontent") );
      $(this).find(".tabcontent").hide();
   
    });*/
  }

  $("#evaluar").click(function(){
      //alert("asd");
      console.log("funcion evaluar");
      var preguntas_input = $(":input");      
      //var preguntas_input = $("[name=respuestas]");
      var i = 0;
      preguntas_input.each(function(index , valor){
          //alert("id: " + $(this).attr('id') + " , esrtado: " + $(this).tagName + " valor: " + valor + ": " + $( this ).text() );
        if ( $(this).prop( "checked" ) ) {
         // alert("esta checked, " + $(this).attr('id') );
          //arreglo[index] = $(this).attr('id');
          //$('[name=arreglo]').val(this.value);
          id = $(this).attr('id');
          nombre = 'id_respuestas['+i+']';
          //alert("nombre: " + nombre);
          //alert("id: " + id);
          $('<input>').attr({
              type: 'hidden',
              id: 'foo',
              name: nombre,
              value: id
          }).appendTo('form');
          i += 1;
        }

      });
  });

  $('.paginador').click(function() {
      console.log("boton paginador " + $(this).val()); 
       
  });

  $('.question').click(function(){
    console.log("se clickeo un elemento de pregunta");
  });
  

  

});
