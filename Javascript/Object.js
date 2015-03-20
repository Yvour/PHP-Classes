
// Проверка корректности для целочисленных значений (анализируется строка)
// Проверяются smallint, integer, bigint (со знаком, так как БД подразумевается Postgresql)
function is_int(x, type) { 
   var y = parseInt(x); 
// 1234567890 
// 	-32768 to +32767
//-2147483648 to +2147483647 Максимальное и минимальное int
// 1234567890123456789
//-9223372036854775808 to 9223372036854775807
   lengths = [5, 10, 19];
   maxminus = ['32768', '2147483648', '9223372036854775808'];
   maxplus  = ['32767', '2147483647', '9223372036854775807'];
   maxes = [maxminus, maxplus];
   indeces = {}; // объект
   indeces['smallint'] = 0;
   indeces['integer'] =1;
   indeces['bigint'] = 2;
   index = indeces[type];
   var reg=/^(\+|\-|)(\d+)$/g; // Регулярное выражение
   if (arr = reg.exec(val))
        {
          signus = arr[1]; // Проверка наличия "знака" числа.
          if (signus == '-') signindex = 0; else signindex = 1;
          digitus = arr[2];

          leng = digitus.length; // Длина строки
          if (leng < lengths[index]){
            return true;
          }
          if (leng > lengths[index]){
            return false
          }; 
          if (leng == lengths[index]){
            CheckFlag = false;
            i=0;
         
            for (i=0;i<leng-1;i++)
            {
            //  alert('digits:' + digitus[i] + 'then' + maxes[signindex][index][i]);
              entereddigit = parseInt(digitus[i]);
              controldigit = parseInt(maxes[signindex][index][i]);
              if (entereddigit > controldigit) return false; // Если цифра больше, перебор
              if (entereddigit < controldigit) return true; // Если меньше, всё ок
            };
            return true; // если цикл пройден, всё ок.
          };
          
          
         }
   else return false;
//   if (isNaN(y)) return false; 
//   return x == y && x.toString() == y.toString(); 
};

function isValidDate(y, m, d)
{
  var dt = new Date();
  dt.setFullYear(y, m-1, d); // Функция setYear уже не рекомендуется к использованию
  // Если дата была восстановлена, успех
  return ((y == dt.getFullYear()) && ((m-1) == dt.getMonth()) && (d == dt.getDate()));
};
	 
// Проверяет введеённое строковое значение на возможность корректного преобразования.
function checkvalue(obj, value, type)
{
//  alert ('value', 'type');
  val = value;
  result = true;
  if ((type == 'integer')||(type == 'smallint')||(type == 'bigint')) // целые типы
  {
     if (is_int(val, type)){
//     obj.style.backgroundColor='#00ff00';
     result = true;

     }
     else {
//     obj.style.backgroundColor='#ff0000';
     result = false;

     };
  } 
  else if (type == 'date') // даты
  {
	var reg=/^(\d+)-(\d+)-(\d+)$/g;
        if (arr = reg.exec(val))
        {
          year = arr[1];
          month = arr[2];
          day   = arr[3];
          if ((isValidDate(year, month, day)))
          {
              //   obj.style.backgroundColor='#00ff00';
            result = true;
          } else {
//                obj.style.backgroundColor='#ff0000';
                result = false;}
        } else {// obj.style.backgroundColor='#ff0000'; 
result = false ;}


  }
else { 
//obj.style.backgroundColor = '#00aaaa';
 result = true;};
return result;
};
