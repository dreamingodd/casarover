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
            // $("#test").click(function () {
            //     $.getJSON('http://localhost/casarover/website/2.0/api/test.php',function (tests) {
            //         vm.items = tests;
            //     }.bind(vm));
            // })
        },

        methods: {
            turn: function (event){
                $.getJSON('http://localhost/casarover/website/2.0/api/test.php',function (tests) {
                    vm.items = tests;
                }.bind(this));
            }
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
            this.fetchcitys()
        },

        methods: {
            fetchcitys: function () {
                $.getJSON('http://localhost/casarover/website/2.0/api/city.php',function (data) {
                    this.citys = data;
                }.bind(this));
            }
        }
    })

    var example = new Vue({
      el: '#example',
      data: {
        a: 1
      },
      created: function(){
        console.log(this.b);
        this.a = 2;
        console.log(this.b);
      },
      computed: {
        // 一个计算属性的 getter
        b: function () {
          // `this` 指向 vm 实例
          return this.a + 1
        }
      }
    })
})
