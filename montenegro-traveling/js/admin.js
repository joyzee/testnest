(function ($) {
  "use strict";
  $(function () {
    $(".nav-tab-wrapper>.nav-tab").each(function (idx, item) {
      $(item).on("click", function (e) {
//      	e = e || window.event;
//	      var target = e.target || e.srcElement;
        $(".tab-content").each(function (idx, item) {
          item.style.display = "none";
        });

        $(".nav-tab-wrapper>.nav-tab").each(function (idx, item) {
          item.className = item.className.replace(" nav-tab-active", "");
        });

        this.className += " nav-tab-active";

        var id = this.getAttribute("data-tab");

        document.getElementById(id).style.display = "block";
      });
    });

//    $(".box-tab-wrapper .category-tabs li").each(function (idx, item) {
//      $(item).on("click", function (e) {
////      	e = e || window.event;
////	      var target = e.target || e.srcElement;
//        $(".box-tab-wrapper .tabs-panel").each(function (idx, item) {
//          item.style.display = "none";
//        });
//
//        $(".box-tab-wrapper .category-tabs li").each(function (idx, item) {
//          item.className = item.className.replace("tabs", "");
//        });
//
//        this.className += "tabs";
//
//        var id = this.getAttribute("data-tab");
//
//        document.getElementById(id).style.display = "block";
//      });
//    });
  });
}(jQuery));