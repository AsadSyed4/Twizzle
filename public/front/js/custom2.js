/* Home Page */
$(document).ready(function () {
    $(".tip_box_heading").click(function () {
        $(this).toggleClass("tip_box_heading_js");
        $(this).parent().toggleClass("tip_box_js");
        $(this).siblings().slideToggle();
        $(this).children(".fa-chevron-up").toggleClass("faq_col_heading_i");

        $(this).parent().siblings().children(".tip_box_heading").removeClass("tip_box_heading_js");
        $(this).parent().siblings(".tip_box").removeClass("tip_box_js");
        $(this).parent().siblings().children(".tip_box_content").slideUp();
        $(this).parent().siblings().children(".tip_box_heading").children(".fa-chevron-up").removeClass("faq_col_heading_i");
    });
    /* Video Slider */
    $('.video_slider').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: false,
        autoplay: true,
        dots: true,
        customPaging: function (slider, i) {
            var thumb = $(slider.$slides[i]).data();
            return '<a>' + (i + 1) + '</a>';
        },
        responsive: [{
            breakpoint: 500,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2
            }
        }]
    });
    /*  Slider */
    $('.s_f_blog').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: false,
        autoplay: true,
        dots: true,
        customPaging: function (slider, i) {
            var thumb = $(slider.$slides[i]).data();
            return '<a>' + (i + 1) + '</a>';
        },
        responsive: [{
            breakpoint: 500,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2
            }
        }]
    });

    /* 
        $('.click_filter label').on('click', function () {
        var array = [];
        $(this).each(function () {
            array.push($(this).text());
        });
        $('.add_filter').html("<span>" + array + "</span>");
        }); 
    */

    /* Header Menu */
    $(".login_btn .fa-bars").click(function () {
        $(".header_menu").toggleClass("header_menu_res");
    });
    $(".header_menu ul .fa-xmark").click(function () {
        $(".header_menu").removeClass("header_menu_res");
    });
    
});
/* Master Plan */
$(document).ready(function () {
    $(".master_plan_inner .list_menu li").click(function () {
        $(this).addClass("list_menu_li");
        $(this).siblings().removeClass("list_menu_li");
    });
    $(".master_plan_inner .list_menu li:nth-of-type(1)").click(function () {
        $(".list_details:nth-of-type(2)").fadeIn(0);
        $(".list_details:nth-of-type(2)").siblings(".list_details").fadeOut(0);
    });
    $(".master_plan_inner .list_menu li:nth-of-type(2)").click(function () {
        $(".list_details:nth-of-type(3)").fadeIn(0);
        $(".list_details:nth-of-type(3)").siblings(".list_details").fadeOut(0);
    });
    $(".master_plan_inner .list_menu li:nth-of-type(3)").click(function () {
        $(".list_details:nth-of-type(4)").fadeIn(0);
        $(".list_details:nth-of-type(4)").siblings(".list_details").fadeOut(0);
    });
    $(".master_plan_inner .list_menu li:nth-of-type(4)").click(function () {
        $(".list_details:nth-of-type(5)").fadeIn(0);
        $(".list_details:nth-of-type(5)").siblings(".list_details").fadeOut(0);
    });
    $(".master_plan_inner .list_menu li:nth-of-type(5)").click(function () {
        $(".list_details:nth-of-type(6)").fadeIn(0);
        $(".list_details:nth-of-type(6)").siblings(".list_details").fadeOut(0);
    });
    $(".master_plan_sec .master_plan_inner .list_menu li").click(function () {
        $(this).addClass("list_menu_li");
        $(this).addClass("master_plan_sec_li");
        $(this).siblings().removeClass("list_menu_li");
        $(this).siblings().removeClass("master_plan_sec_li");
    });
});
/* ----------------- */
$(document).ready(function () {
    $(".plane_inner .Our_plane .plane_content .box .heading").click(function () {
        $(this).children(".fa_angle_ups").toggle();
        $(this).children(".fa_angle_downs").toggle();
        $(this).siblings().slideToggle();
        $(this).parent(".box_inner").parent(".section").siblings().slideToggle();
        $(this).parent(".box_inner").parent(".section").siblings().css("display", "flex");
        $(this).parent(".box_inner").parent(".section").parent(".box").siblings().children(".sub_boxs").slideUp();
        $(this).parent(".box_inner").parent(".section").parent(".box").siblings().children(".sub_boxs").css("display", "none");
        $(this).parent(".box_inner").parent(".section").parent(".box").siblings().children(".section").children(".box_inner").children(".content").slideUp();
        $(this).parent(".box_inner").parent(".section").parent(".box").siblings().children(".section").children(".box_inner").children(".heading").children(".fa_angle_ups").hide();
        $(this).parent(".box_inner").parent(".section").parent(".box").siblings().children(".section").children(".box_inner").children(".heading").children(".fa_angle_downs").show();
    });
});
$(document).ready(function () {
    $(".faq_box .content .faq_heading").click(function () {
        $(this).children(".slide_down").toggle();
        $(this).children(".slide_up").toggle();
        $(this).siblings().slideToggle();
        $(this).parent(".box").parent(".outline").siblings().children(".box").children(".faq_content").slideUp();
        $(this).parent(".box").parent(".outline").siblings().children(".box").children(".faq_heading").children(".slide_up").slideUp();
        $(this).parent(".box").parent(".outline").siblings().children(".box").children(".faq_heading").children(".slide_down").slideDown();
    });
});
$(document).ready(function () {
    $(".faq_box ul li").click(function () {
        $(this).addClass("add_class_faq");
        $(this).siblings().removeClass("add_class_faq");
    });
    $(".content_1_btn").click(function () {
        $(".content").removeClass("add_class_content");
        $(".content_1").addClass("add_class_content");
    });
    $(".content_2_btn").click(function () {
        $(".content").removeClass("add_class_content");
        $(".content_2").addClass("add_class_content");
    });
    $(".content_3_btn").click(function () {
        $(".content").removeClass("add_class_content");
        $(".content_3").addClass("add_class_content");
    });
    $(".content_4_btn").click(function () {
        $(".content").removeClass("add_class_content");
        $(".content_4").addClass("add_class_content");
    });
});
$(document).ready(function () {
    $(".clear_all").click(function () {
        $(".select_category").parent(".category").hide();
    });
});
/* ------------- */
$(document).ready(function () {
    $(".login").click(function () {
        $(".login_pop").fadeIn();
    });
    $(".login_pop_btn").click(function () {
        $(".login_pop").fadeOut();
        $(".schedule_pop").fadeOut();
    });
});
/* ------------- */
$(document).ready(function () {
    $(".export").click(function () {
        $(".addnew").fadeIn();
    });
    $(".export2").click(function () {
        $(".addnew2").fadeIn();
    });
    $(".export3").click(function () {
        $(".backup").fadeIn();
    });
    $(".export3").click(function () {
        $(".backup").fadeIn();
    });
    $(".addnew_pop_btn").click(function () {
        $(".addnew").fadeOut();
    });
});
/* --------------- */
$(document).ready(function () {
    $(".grammer_btn").click(function () {
        $(this).addClass("mistake_li_class");
        $(this).siblings().removeClass("mistake_li_class");
        $(".mistake .grammer").siblings().hide();
        $(".mistake .grammer").show();
    });
    $(".Content_btn").click(function () {
        $(this).addClass("mistake_li_class");
        $(this).siblings().removeClass("mistake_li_class");
        $(".mistake .Content").siblings().hide();
        $(".mistake .Content").show();
    });
    $(".structure_btn").click(function () {
        $(this).addClass("mistake_li_class");
        $(this).siblings().removeClass("mistake_li_class");
        $(".mistake .structure").siblings().hide();
        $(".mistake .structure").show();
    });
    $(".effective_btn").click(function () {
        $(this).addClass("mistake_li_class");
        $(this).siblings().removeClass("mistake_li_class");
        $(".mistake .effective").siblings().hide();
        $(".mistake .effective").show();
    });
});
/* ---------------- */
function PreviewImage() {
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

    oFReader.onload = function (oFREvent) {
        document.getElementById("uploadPreview").src = oFREvent.target.result;
    };
};
/* Calendar */
$(document).ready(function () {
    $(".month ul:nth-of-type(1) li a").click(function () {
        $(this).addClass("date_status");
        $(this).parent().siblings().children().removeClass("date_status");
    });
    $(".schedule").click(function () {
        $(".schedule_pop").fadeIn("active");
    });
    $(".checked").click(function () {
        $(this).addClass("active");
        $(this).siblings().removeClass("active");
    });

    $(".checked1").click(function () {
        $(".event").addClass("active_class");
        $(".event").siblings().removeClass("active_class");
    });
    $(".checked2").click(function () {
        $(".task").addClass("active_class");
        $(".task").siblings().removeClass("active_class");
    });
    $(".checked3").click(function () {
        $(".reminder").addClass("active_class");
        $(".reminder").siblings().removeClass("active_class");
    });
});
/* FAQs */
$(document).ready(function () {
    $(".faq_col_heading").click(function () {
        $(this).children(".faq_col .faq_col_heading i").toggleClass("faq_col_heading_i");
        $(this).siblings(".faq_col_content").slideToggle();
        $(this).parent().parent().siblings().children().children(".faq_col .faq_col_heading").children("i").removeClass("faq_col_heading_i");
        $(this).parent().parent().siblings().children().children(".faq_col_content").slideUp();
    });
});
/* ---------------- */