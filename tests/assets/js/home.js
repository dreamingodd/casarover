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

    var recom = new Vue({
        el:'#recom',
        data: function(){
            return null
        },
        created: function(){
            this.getRecom;

        },

        methods: {
            getRecom: function (event){
                $.getJSON('api/home.php?c=recom',function (data) {
                    vm.items = data;
                }.bind(this));
            }

        }
    })
    var theme = new Vue({
        el: '#theme',
        data: function () {
            return {
                items:[{message:'1',short:'qwe',pic:"assets/images/fang.jpg"}]
            };
        },

        created: function () {
            vm = this;
            // $("#test").click(function () {
            //     $.getJSON('http://localhost/casarover/website/2.0/api/test.php',function (tests) {
            //         vm.items = tests;
            //     }.bind(vm));
            // })
            // console.log($(document.body).outerHeight(true));
        },

        methods: {
            turn: function (event){
                $.getJSON('api/home.php?c=recom',function (tests) {
                    vm.items = tests;
                    //console.log(tests);
                    // window.scrollTo(0,document.body.clientHeight);
                    // 这样 获取的值还是一样的
                    // console.log($(document.body).outerHeight(true));
                    $("html,body").animate({"scrollTop": "1700px"}, 1000);
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
