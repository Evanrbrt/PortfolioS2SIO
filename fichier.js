let date1 = Date();
document.getElementById('p1').innerHTML = date1;





var timerRunning = false;
function runClock() 
{
  var today   = new Date();
  var hours   = today.getHours();
  var minutes = today.getMinutes();
  var seconds = today.getSeconds();
  var timeValue = hours;
 
  // Les deux prochaines conditions ne servent que pour l'affichage.
  // Si le nombre de minutes est inférieur à 10, alors on ajoute un 0 devant...
 
  timeValue += ((minutes < 10) ? ":0" : ":") + minutes;
  timeValue += ((seconds < 10) ? ":0" : ":") + seconds;
  document.getElementById("time").value = timeValue;
  timerRunning = true;
}
 
var timerID = setInterval(runClock,1000);






