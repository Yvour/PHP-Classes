


$(document).ready(function()
{

//$('head').append('<script type="text/javascript" src = "rightclick.js"></script>');
//$('table').bind("contextmenu",function(e){ return false; });
//$('tr').bind("contextmenu",function(e){ return false; });
  $('body').bind("contextmenu", function(e) {
    return false;
  });

  $('tr').on('mouseover', function() {
    $(this).addClass('one');
  }
  );

  $('tr').on('mouseleave', function() {
    $(this).removeClass('one');
  }
  );


  $('td').on('mouseover', function() {
    $(this).addClass('two');
  }
  );

  $('td').on('mouseleave', function() {
    $(this).removeClass('two');
  }
  );

  $('#menu1').on('click', function() {
    // alert('menuclick');
  }
  );

  $('#editbutton').on('click', function() {
    $('#buttonmode').val($(this).data('mode'));
    $('#menuform').submit();
  });

  $('#historybutton').on('click', function() {
//  $('#menu1').hide();

    $('#buttonmode').val($(this).data('mode'));
    $('#menuform').submit();
  });


  $('#menuclose').mousedown(function() {
    $('#menu1').hide();
  });

  $('.linkbutton').mousedown(function() {
    $('#ItemID').attr('name', $(this).data('foreignname'));
    $('#buttonmode').val($(this).data('mode'));
    $('#menuform').attr('action', $(this).data('action'));
    $('#menuform').submit();
  });



  $('.datacell').mousedown(function(event) {
    var button = 0;
    switch (event.which) {
      case 1:
//            alert('Left mouse button pressed');
        button = 1;
        break;
      case 2:
//            alert('Middle mouse button pressed');
        button = 2;
        break;
      case 3:
        button = 3;
//            alert('Right mouse button pressed');
        break;
      default:
//            alert('You have a strange mouse');
    }
    if (button == 1) {
      $('#menu1').hide();
    }
    ;
    if (button == 3) {
      $('#foreignlink').hide();
      if ($(this).hasClass('foreigndatacell')) {
        $('#foreignlink').show();
        $('#foreignlink').text($(this).data('foreigncaption'));
        $('#foreignlink').data('foreignid', $(this).data('foreignid'));
        $('#foreignlink').data('action', $(this).data('foreignaction'));
        $('#foreignlink').data('mode', 'showlist');
        $('#foreignlink').data('foreignname', $(this).data('foreignname'));
        $('#foreignlink').mousedown(function() {
          $('#ItemID').val($(this).data('foreignid'));
          $('#ItemID').attr('name', $(this).data('foreignname'));
          $('#buttonmode').val($(this).data('mode'));
          $('#menuform').attr('action', $(this).data('action'));
          $('#menuform').submit();
        });
      }
      ;

      $('#ItemID').val($(this).data('id'));
      // Сброс счётчиков
      $('.linkcount').html('...');
      // Необходимо вывести число ссылок
      url = "http://" + $('#dataspan').data('host') + "/Objects/Sys/" + $('#menu1').data('scriptname') + '?request=json_linkedobjectcount&id=' + $(this).data('id');
      
      
//var obj=new Object();
 // obj.name='human';  
 // obj.family='horilla';      
  //alert(JSON.stringify(obj));
      
    
      $.getJSON(url,
              function(data) {
                $.each(data, function(i, item)
                {
                  $('#' + i).html(item);
                });

              });



      $('#menu1').show();
      $('#menu1').offset({top: $(this).offset().top, left: $(this).offset().left});

    }
    ;
  });


});
