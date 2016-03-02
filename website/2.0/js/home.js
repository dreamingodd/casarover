$(document).ready(function(){
    $('.flexslider').flexslider({
        directionNav: true,
        pauseOnAction: false
    });
    $('.search-input input').click(function(){
        $('.search-place').css('display','block');
    })
    $('.search-input input').blur(function(){
        $('.search-place').css('display','none');
    })
    var theme = new Vue({
        el: '#theme',
        data: function () {
            return {
                items:[{message:'1',short:'qwe',pic:"images/fang.jpg"}]
            };
        },

        created: function () {
            vm = this;
            $("#test").click(function () {
                $.getJSON('http://localhost/casarover/website/2.0/api/test.php',function (tests) {
                    vm.items = tests;
                }.bind(vm));
            })

        }
    })
    var city = new Vue({
        el: '#city',
        data: function () {
            return {
                citys:[]
            };
        },

        created: function () {
            $.getJSON('http://localhost/casarover/website/2.0/api/city.php',function (data) {
                this.citys = data;
            }.bind(this));
        }
    })
})
