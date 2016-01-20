$(function(){
    /**民宿列表显示*/
    var appUrl = getAppUrl();
    loadNew();
    var page=0;
    $(window).scroll(function(){
        var screenT = $(window).scrollTop();
        var doc = $(document).height();
        var win = $(window).height();
        if (screenT >= doc - win) {
            page+=1;
            loadNew(page);
        };
    });
    function loadNew(number) {
        var city_id = $('#city_id').val();
        var themes = $('#themes').val();
        var sceneries = $('#sceneries').val();
        var getUrl = appUrl + "controllers/CityController.php";
        $.ajax({
        type:'get',
        url: getUrl,
        data: {
            area_id:city_id,
            themes:themes,
            sceneries:sceneries,
            page:page
        },
        success: function(data) {
            // console.log(data);
            var long = data.result.length;
            if (long == 0 ) {
                var room = '<div class="col-md-12  room " style="text-align:center" ><input id="nomore" type="hidden" value="1" />没有更多了</div>';
                var endif = $("#nomore").val();
                if (endif == 1) {
                    return;
                } else{
                    $(".show-result").append(room);
                    return;
                };
            };
            for (var i = 0; i < long; i++) {
                var room = '<div class="col-md-4 col-sm-6 room"> <div class="house-message"><div class="top"><a href="casa.php?casa_id='+data.result[i].id+'" target="_blank"><img src="../../photo/'+data.result[i].main_photo_name+'" alt=""></a></div><div class="bottom"><h4><a href="casa.php?casa_id='+data.result[i].id+'">'+data.result[i].name+'</a></h4></div></div></div>';
                $(".show-result").append(room);
            };
            // 民宿缩略图显示调整
            setTimeout(adjust_casa_thumbnail, 50);
        },
        dataType: 'json',
        error:function () {
            alert("something is wrong");
        }
        });
    }
    // 头部slider
    $('.flexslider').flexslider({
        directionNav: true,
        pauseOnAction: false
    });
    /* display the selected checkboxes. */
    var themes = $('#themes').val();
    var sceneries = $('#sceneries').val();
    var prices = $('#prices').val();
    var themeIdArray = [], sceneryIdArray = [], priceIdArray = [];
    if (themes) themeIdArray = themes.split(',');
    if (sceneries) sceneryIdArray = sceneries.split(',');
    if (prices) priceIdArray = prices.split(',');
    themeIdArray.forEach(function(e){
        $('#theme_'+e).val(1);
        $('#theme_'+e).css("color","#ffffff");
        $('#theme_'+e).css("background","#0066FF");

    });
    sceneryIdArray.forEach(function(e){
        $('#scenery_'+e).val(1);
        $('#scenery_'+e).css("color","#ffffff");
        $('#scenery_'+e).css("background","#0066FF");
    });
    priceIdArray.forEach(function(e){
        $('#price_'+e).val(1);
        $('#theme_'+e).css("color","#ffffff");
    });
    /* End: display the selected checkboxes */
    // 当点击checkbox的时候
    $('.condition li').click(function() {
        if (this.value) {
            $("#"+this.id).val(0);
        }else{
            $("#"+this.id).val(1);
            $("#"+this.id).css("color","#ffffff");
            $("#"+this.id).css("background","#0066FF");
        }
        checkbox_change();
    });
    // $('li').click(checkbox_change);
    // 当点击全部的时候
    $('.psm-all').click(checkbox_change);
    // TODO uncompleted
    $('.price').click(uncompleted);
    // 轮播图比例问题
    // setTimeout(adjust_height($('.slides li'), 2.2), 10);
    // $(window).resize(adjust_height($('.slides li'), 2.2));
    // 有可能会有问题
    $("#more-theme").click(function () {
        $(".right").toggleClass('right-extend');
        var showmore = $(".sel-main").height();
        if (showmore > 50) {
            $("#more-theme").html("收起");
        } else{
            $("#more-theme").html("展开");
        };
    })
});

/**
 * get the id from the checkbox's id.
 * e.g. area_13, return 13.
 * e.g. price_150-300, return 150-300.
 * @param id_str
 */
function getNumeric(id_str) {
    if (!id_str) {
        console.log('Error: id_str is null!');
        return 0;
    } else if (id_str.lastIndexOf("_")>=0) {
        id = id_str.split("_")[1];
        if (!id) {
            console.log('Error: id is missing!');
        } else return id;
    } else {
        console.log('Error: parse format is not %_%!');
        return 0;
    }
}

function checkbox_change(){
    // 点击全部
    if ($(this)[0].id=='theme_all') $('.theme').val('0');
    else if ($(this)[0].id=='scenery_all') $('.scenery').val('0');
    else if ($(this)[0].id=='price_all') $('.price').val('0');
    // collect checked items to a id string
    themes = sceneries = prices = "";
    var city_id = $('#city_id').val();
    $('.theme').each(function(){
        if (this.value == 1) {
            var dom_id = this.id;
            id = getNumeric(dom_id);
            if (themes) themes += "," + id;
            else themes = id;
        }
    });
    $('.scenery').each(function(){
        if (this.value == 1) {
            var dom_id = this.id;
            id = getNumeric(dom_id);
            if (sceneries) sceneries += "," + id;
            else sceneries = id;
        }
    });
    $('.price').each(function(){
        if (this.value == 1) {
            var dom_id = this.id;
            id = getNumeric(dom_id);
            if (prices) prices += "," + id;
            else prices = id;
        }
    });
    location.href = 'city_search.php?area_id=' + city_id + '&themes=' + themes
            + '&sceneries=' + sceneries + '&prices=' + prices + '#multi-condition_search';
}