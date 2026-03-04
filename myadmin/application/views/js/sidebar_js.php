<script type="text/javascript">
$(document).ready(function(e){
//=========================SideBar============================//
decide_active_nevmenu();
//=========================SideBar============================//
function decide_active_nevmenu(){
  var current_link = window.location.href,
  sidebar_links = $(".menu-section").find(".mynev-links"), 
  amenu_link, amenu_link2, my_atag, my_li, my_ul,
  current_link2 = current_link.split("?");
  current_link2 = current_link2[0];

  sidebar_links.each(function( i ) { my_atag = $(this);
    amenu_link = my_atag.attr('href').split("?");
    amenu_link2 = amenu_link[0];

    if (amenu_link2 == current_link2) {
      my_li = my_atag.parents("li").eq(0);
      my_ul = my_li.parents("ul").eq(0);

      if (my_ul.hasClass("mynev-menus")) {
        my_li.addClass("active"); return;
      }else if (my_ul.hasClass("mynev-submenus")) {
        my_ul.removeClass("collapse");
        my_ul.addClass("collapse in");
        my_ul.removeAttr("style");
        my_ul.parents("li").eq(0).removeClass("active");
        my_ul.parents("li").eq(0).children("a").eq(0).removeClass("collapsed");
        my_li.addClass("active");
        return;
      }
    }
  });
}
//========================/SideBar============================//

//========================/SideBar============================//
});
</script>