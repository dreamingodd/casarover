$(function(){
    var web_url = getWebUrl();
    var cities_json = $('#cities_json').val();
    var province_json = $('#provincesWithSub_json').val();
    var cities = JSON.parse(cities_json);
    var provinces = JSON.parse(province_json);
    var area_data = {};
    var hot_array = [];
    var province_array = [];
    for (key in cities) {
        var city = cities[key];
        hot_array.push(city);
    }
    for (key in provinces) {
        var province = provinces[key];
        province.city = province.sub_areas;
        province_array.push(province);
    }
    area_data.hot = hot_array;
    area_data.province = province_array;
    var cityPicker = new HzwCityPicker({
        data: area_data,
        target: 'cityChoice',
        valType: 'k-v',
        hideCityInput: {
            name: 'city',
            id: 'city'
        },
        hideProvinceInput: {
            name: 'province',
            id: 'province'
        },
        callback: function(id){
            var id_name = document.getElementById('city').value.split('-');
            var id = id_name[0];
            //var name = id_name[1];
            location.href = web_url + 'city_search.php?area_id=' + id;
        }
    });
    cityPicker.init();
});