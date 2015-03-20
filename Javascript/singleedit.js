

$(document).ready(function()
{
   $('tr').on('mouseover',  function(){
   $(this).addClass('one');
   }
   );

   $('tr').on('mouseleave',  function(){
   $(this).removeClass('one');
   }
   );


   $('td').on('mouseover',  function(){
   $(this).addClass('two');
   }
   );

   $('td').on('mouseleave',  function(){
   $(this).removeClass('two');
   }
   );


	   
                 
  $("form").on('submit', function(event) 
  {// обрабатываем отправку формы    

    var result = true; // Если проверка хотя бы одного элемента обломается, то будет false
    $.each($(this).find('input[type=text]'), function ()
    {
//      alert($(this).closest('td').find('input[type=hidden]').val());
      if (checkvalue($(this), $(this).val(), $(this).closest('td').find('input[type=hidden]').val()))
      {
         //alert('correct');
      } else 
      { 
         alert($(this).attr('name') + ' ' + 'not correct as ' + $(this).val()); 
         $(this).closest('td').append('error');
         result = false;
      };



    }); // of each
  return result;
  }); /// of form.submit
             
             
                 
   


});

