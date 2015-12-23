var wt = new Array();
wt[0] = "Giông tố";
wt[1] = "Bão nhiệt đới";
wt[2] = "Bão";
wt[3] = "Nhiều sấm sét";
wt[4] = "Sấm sét";
wt[5] = "Mưa và tuyết";
wt[6] = "Mưa tuyết";
wt[7] = "Mưa tuyết";
wt[8] = "Mưa phùn";
wt[9] = "Mưa bụi";
wt[10] = "Mưa đá";
wt[11] = "Mưa rào";
wt[12] = "Mưa rào";
wt[13] = "Có mưa giông";
wt[14] = "Tuyết rơi nhẹ";
wt[15] = "Tuyết rơi";
wt[16] = "Tuyết";
wt[17] = "Mưa đá";
wt[18] = "Mưa tuyết";
wt[19] = "Bụi";
wt[20] = "Sương mù";
wt[21] = "Sương mù";
wt[22] = "Mù mịt";
wt[23] = "Gió to";
wt[24] = "Nhiều gió";
wt[25] = "Lạnh";
wt[26] = "Trời âm u";
wt[27] = "Trời nhiều mây";
wt[28] = "Trời nhiều mây";
wt[29] = "Trời ít mây";
wt[30] = "Trời ít mây";
wt[31] = "Trời quang";
wt[32] = "Trời nắng";
wt[33] = "Trời đẹp";
wt[34] = "Trời đẹp";
wt[35] = "Mưa và mưa đá";
wt[36] = "Nóng nực";
wt[37] = "Chỉ có sấm sét";
wt[38] = "Sấm sét rải rác";
wt[39] = "Sấm sét rải rác";
wt[40] = "Mưa rải rác";
wt[41] = "Tuyết rơi";
wt[42] = "Mưa tuyết rải rác";
wt[43] = "Tuyết rơi nhẹ";
wt[44] = "Ít mây";
wt[45] = "Sấm sét";
wt[46] = "Mưa tuyết";
wt[47] = "Mưa sấm sét";
wt[3200] = "Không có dữ liệu";

var dr = new Array();
dr['North'] = "bắc";
dr['Northeast'] = "đông bắc";
dr['East'] = "đông";
dr['Southeast'] = "đông nam";
dr['South'] = "nam";
dr['Southwest'] = "tây nam";
dr['West'] = "tây";
dr['Northwest'] = "tây bắc";

var wday = new Array();
wday['Mon'] = "Thứ Hai";
wday['Tue'] = "Thứ Ba";
wday['Wed'] = "Thứ Tư";
wday['Thu'] = "Thứ Năm";
wday['Fri'] = "Thứ Sáu";
wday['Sat'] = "Thứ Bảy";
wday['Sun'] = "Chủ Nhật";

function showWeather(url) {
    $.ajax({
        url: document.location.protocol + '//ajax.googleapis.com/ajax/services/feed/load?v=1.0&output=xml&callback=?&q=' + encodeURIComponent(url),
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            var fcast_tday = fcast_tomo = wind = atmo = '';
            $(data.responseData.xmlString).find('yweather\\:wind').each(function () {
                var dir = parseInt($(this).attr('direction'));
                var huong = '';
                switch (true) {
                case (dir == 0):
                    huong = 'North';
                    break;
                case (dir < 90):
                    huong = 'Northeast';
                    break;
                case (dir == 90):
                    huong = 'East';
                    break;
                case (dir < 180):
                    huong = 'Southeast';
                    break;
                case (dir == 180):
                    huong = 'South';
                    break;
                case (dir < 270):
                    huong = 'Southwest';
                    break;
                case (dir == 270):
                    huong = 'West';
                    break;
                case (dir < 360):
                    huong = 'Northwest';
                    break;
                case (dir == 360):
                    huong = 'North';
                    break;
                }
                if (lang == 'vi_VN') wind = 'Gió ' + huong;
                else wind = huong + ' Winds ';
                wind = wind + ' ' + $(this).attr('speed');
            });
            $(data.responseData.xmlString).find('item').each(function () {
                if (numday > 1) {
                    $(this).find('yweather\\:forecast').each(function (index) {
                        if (!fcast_tday) fcast_tday = '<span>' + $(this).attr('low') + '&deg;-' + $(this).attr('high') + '&deg;</span>';
                        else {
                            var d = new Date($(this).attr('date'));
                            var dstring = d.getDate() + '/' + (d.getMonth() + 1);
                            var day_tomo = $(this).attr('day');
                            if (lang == 'vi_VN') day_tomo = wday[day_tomo];
                            fcast_tomo += '<span>' + day_tomo + ', ' + dstring + ': <img align="absmiddle" height="24" src="http://l.yimg.com/a/i/us/we/52/' + $(this).attr('code') + '.gif">' + $(this).attr('low') + '&deg;-' + $(this).attr('high') + '&deg;</span><br/>' ;
                        }
                        return index < numday;
                    });
                }
                else {
                    $(this).find('yweather\\:forecast').each(function () {
                        if (!fcast_tday) fcast_tday = '<span>' + $(this).attr('low') + '&deg;-' + $(this).attr('high') + '&deg;</span>';
                        else if (!fcast_tomo) {
                            var d = new Date($(this).attr('date'));
                            var dstring = d.getDate() + '/' + (d.getMonth() + 1);
                            var day_tomo = $(this).attr('day');
                            if (lang == 'vi_VN') day_tomo = wday[day_tomo];
                            fcast_tomo = '<span>' + day_tomo + ', ' + dstring + ': <img align="absmiddle" height="24" src="http://l.yimg.com/a/i/us/we/52/' + $(this).attr('code') + '.gif">' + $(this).attr('low') + '&deg;-' + $(this).attr('high') + '&deg;</span>';
                        }
                    });
                }

                $(this).find('yweather\\:condition').each(function () {
                    var wt_text = $(this).attr('text');
                    var code = $(this).attr('code');
                    if (lang == 'vi_VN') wt_text = wt[parseInt(code)];
                    html = '<p style="margin:0px 0px 3px 0px"><b>' + wt_text + '</b><br/><img height="60" align="left" src="' + imgdef + code + '.png" /> ' + fcast_tday + '<br /><span style="font-size:30px; text-shadow:0 1px 1px #333;">' + $(this).attr('temp') + '&deg;C</span></p>' + '<div class="txtNhodi">' + wind + ' km/h<br/>' + fcast_tomo + '</div>';
                    document.getElementById('showWeather').innerHTML = html;
                });
            });
        }
    });
}

function show_me() {
    var location = document.getElementById('loc').value;
    if (location != 'undefined') {
        nv_setCookie('dloc', location, 7);
        showWeather("http://weather.yahooapis.com/forecastrss?w=" + location + "&u=c&d=" + (new Date()).getTime());
    }
}
$(document).ready(function () {
    var location = nv_getCookie('dloc');
    if (!location) location = locdef;
    document.getElementById('loc').value = location;
    showWeather("http://weather.yahooapis.com/forecastrss?w=" + location + "&u=c&d=" + (new Date()).getTime());
});
