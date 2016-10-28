function selectorMenu(idMenu){
    jQuery("#"+idMenu).addClass("active");
}

function timeCountdown(element){
    var endDate = $('#'+element).attr('data-date');
    var target_date = new Date(endDate).getTime();
    var days, hours, minutes, seconds;
    var szCountTime;
    setInterval(function () {
        // find the amount of "seconds" between now and target
        var current_date = new Date().getTime();
        var seconds_left = (target_date - current_date) / 1000;
     
        // do some time calculations
        hours = parseInt(seconds_left / 3600);
        seconds_left = seconds_left % 3600;
         
        minutes = parseInt(seconds_left / 60);
        seconds = parseInt(seconds_left % 60);
         
        if(hours == 0 && minutes == 0 && seconds == 0){
             window.location.reload();
        }
        // format countdown string + set tag value
        szCountTime = '<span><code>' + hours + ':' + minutes + ':' + seconds + '</code></span>';
        $('#'+element).html(szCountTime);
    }, 1000);
}