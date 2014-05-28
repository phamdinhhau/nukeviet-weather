<!-- BEGIN: main -->
<script type="text/javascript">
    var lang = 'vi_VN', locdef = '{CODE}', imgdef = '{NV_BASE_SITEURL}', numday = '{NUM_DAY}';
</script>
<script type="text/javascript" src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/weather.min.js"></script>
<div>
    <select id="loc" onchange="show_me();" style="width:120px"> 
    <!-- BEGIN: loop -->
        <option value="{ROW.location_code}"{ROW.selected}>{ROW.location_name}</option>
    <!-- END: loop -->
    </select>
    <div id="showWeather"></div>
</div>
<!-- END: main -->
