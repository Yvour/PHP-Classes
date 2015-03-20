function setValue(id, value, textvalue)
{
  //window.returnValue = "5";

//  window.opener.document.forms['bI'].elements['to'].value = $value;
   window.opener.document.getElementById(id).value = value;
   window.opener.document.getElementById(id+'text').innerHTML = textvalue;
  this.close();
//  window.parent.name = 'WalterScott';
};



$(document).ready(function()
{
  /* $('tr').on('click',  function(){ 
   $(this).addClass('one');
   }
   );
/*
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


*/	   
                 



});
