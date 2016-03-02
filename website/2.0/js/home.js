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
    new Vue({
        el: '#theme',
        data: function () {
            return {
                items:[{message:'1',short:'qwe'}]
            };
        },

        created: function () {
            vm = this;
            console.log(this.items);
            $("#test").click(function () {
                $.getJSON('http://localhost/casarover/website/2.0/api/test.php',function (tests) {
                    // console.log(tests);
                    vm.items = tests;
                    // console.log(vm.items);
                }.bind(vm));
            })

        }
    })
})
