$(document).ready(function(){
    // 微信qrcode
    $("#wx").mouseover(function(){
        $("#wxImg").css("display","block");
    });
    $("#wx").mouseout(function(){
        $("#wxImg").css("display","none");
    });
    // 手机搜索框
    $(".m-full").height($(document).height());
    $("#search").click(function(){
        $("#full-search").css('display','block');
    });
    $(".back").click(function(){
        $("#full-search").css('display','none');
    });
    $('.uncompleted').click(uncompleted);
});//end document
/**
 * 给链接加上uncompleted.
 * @param e
 */
function uncompleted(e) {
    e.preventDefault();
    alert('此功能期待完善！');
}
/**
 * 跳转页面的方法
 * @param area's or casa's id
 */
function goto_casa(id) {
    var web_url = getWebUrl();
    location.href = web_url + "casa.php?casa_id=" + id;
}
function goto_city(id) {
    var web_url = getWebUrl();
    location.href = web_url + "city_search.php?area_id=" + id;
}
function goto_area(id) {
    var web_url = getWebUrl();
    location.href = web_url + "area_guide.php?area_id=" + id;
}
/**
 * Make the input border red.
 * @param input JQuery DOM object
 */
function input_error(input) {
    input.css('input_error');
}
/**
 * Below 3 methods are input parameter check methods.
 * @param str input 
 * @returns whether the input string is standard.
 */
function is_cellphone_number(str) {
    var pattern = /^\d{11}$/;
    return pattern.test(str);
}
function is_legal_password(str) {
    var pattern1 = /([a-zA-z]+\d+)|(\d+[a-zA-z]+)/;
    var pattern2 = /\w{6,}/;
    return pattern1.test(str) && pattern2.test(str);
}
function is_legal_verify_code(str) {
    var pattern = /^\d{6}$/;
    return pattern.test(str);
}
/**
 * Get a random number which digits < 15.
 * @param digits
 * @returns random number
 */
function getRandom(digits) {
    return Math.round(Math.random() * Math.pow(10, digits));
}
/**
 * Based on the method - getUrl() of common_tools.php.
 * The PHPs are generally in the website folder which will be returned in getUrl().
 * We suppose the getUrl() returns http://Realm/project/website/
 * @returns http://Realm/website/
 */ 
function getWebUrl() {
    if ($('#web_url').val()) {
        return $('#web_url').val();
    } else alert("Web_url is missing! getUrl() is not invoked on PHP file!");
}
/**
 * Suppose returns http://Realm/project/application/
 * @returns application url
 */
function getAppUrl() {
    return getWebUrl().replace('website', 'application');
}
/**
 * Suppose returns http://Realm/project/
 * @returns base url
 */
function getBaseUrl() {
    return getWebUrl().replace('website/', '');
}
/**
 * Remove elements whose attr==val from an array.
 * Notice: original array will NOT be changed, must change the array pointer.
 * @arr array
 * @attr attribute name
 * @val attribute value
 * @returns a new array.
 */
function arrayRemoveElements(arr, attr, val) {
    var new_array = [];
    for (var i in arr) {
        if (arr[i][attr] != val) {
            new_array.push(arr[i]);
        }
    }
    return new_array;
}
/**
 * Parse the hash of GET url.
 * @location.hash
 * Return an array of variables.
 */
function getHashVals(hash) {
    var vals = {};
    if (hash) {
        // Strip "#"
        hash = hash.replace(new RegExp(/#/g),'');
        var val_array = hash.split('&');
        for (var i in val_array) {
            // split by "=", 0 is attribute name, 1 is attribute value.
            var key_val_array = val_array[i].split("=");
            if (key_val_array.length = 2) {
                vals[key_val_array[0]] = key_val_array[1];
            }
        }
    } else {
        console.log("hash is null!");
    }
    return vals;
}
/**
 * Adjust the DOM's height by proportion.
 * 按比例调整元素的高度。
 */
function adjust_height(dom, proportion) {
    return function _adjust_height() {
        $(dom).each(function(){
            var width = $(this).css('width').replace('px', '');
            var preHeight = $(this).css('width').replace('px', '');
            var height = Math.floor(width/proportion);
            if (preHeight) {
                if (preHeight > height) {
                    $(this).css('height', height + 'px');
                }
            } else {
                $(this).css('height', height + 'px');
            }
        });
    };
}

/**
 * Adjust width or height of the casa thumbnail.
 * The img shall be in css-class house-message top.
 * 民宿图标显示，最终效果为：
 * 宽高比大于3:2的：纵向全部显示，横向居中，简单来说就是显示的时候图片的左右被截掉了一部分；
 * 宽高比小于3:2的：横向全部显示，纵向居中，简单来说就是显示的时候图片的上下被截掉了一部分。
 * 
 * Scope: HomePage's 主题推荐 & CityPage's 民宿列表
 */
function adjust_casa_thumbnail() {
    $('.house-message img').each(function(){
        setTimeout(adjust_one_thumbnail($(this), 320, 200), 100);
    });
}
function adjust_one_thumbnail(dom, width, height) {
    return function _adjust_one_thumbnail() {
        // 若高度小于200px，则显示下方会留空白，需要处理
        if (dom.css('height')) {
            if (dom.css('height').replace('px','') < height) {
                dom.css('max-width', '10000px');
                dom.css('max-height', height + 'px');
                var img_width = dom.css('width').replace('px','');
                var img_left = (img_width - width) / 2;
                dom.css('position', 'relative');
                dom.css('left', '-' + img_left + 'px');
            } else {
                var img_height = dom.css('height').replace('px','');
                var img_top = (img_height - height) / 2;
                dom.css('position', 'relative');
                dom.css('top', '-' + img_top + 'px');
            }
        } else {
            alert('图片加载超时！');
        }
    };
}