var timesUp = "Your time is up!",
    text = document.getElementById('date'),
    day = document.getElementById('day'),
    hour = document.getElementById('hour'),
    min = document.getElementById('minute'),
    sec = document.getElementById('second');
    // finalDate = new Date("July 27, 2014 11:13:00");

function getTime(url, success){
  $.ajax({
      type : 'GET',
      dataType : 'jsonp',
      url : url,
      success : success,
      error : function(jqXHR, textStatus, errorThrown){
          // console.log('fail', jqXHR, textStatus, errorThrown);
          text.innerHTML = 'Ups, there was an error.';
      }
  });
}

function countdown(remaining){
  function n(n){
      return n > 9 ? "" + n: "0" + n;
  }
  var tDay=Math.floor(remaining/86400),
      tHour=Math.floor((remaining % 86400) / 3600),
      tMin=Math.floor((remaining % 3600) / 60),
      tSec=Math.floor(remaining % 60);
  if (remaining<=0){
      text.innerHTML = timesUp;
  }else{
    days = day.innerHTML = n(tDay);
    hours = hour.innerHTML = n(tHour);
    mins = min.innerHTML = n(tMin);
    secs = sec.innerHTML = n(tSec);
  }
}

getTime('//www.digitalstores.co.uk/countdown/time-jsonp.php?callback=', function(json){
  // var date = getTime( finalDate) || json.endDate,
  var date = json.endDate,
      time = json.nowTime,
      remaining=date-time;
  countdown(remaining);
  window.setInterval(function(){
    remaining = remaining-1;
    countdown(remaining);
  }, 1000);
});