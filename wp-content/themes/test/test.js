$(document).ready(function(){
    $('ul.sub-menu').addClass('dropdown-menu').attr('role', 'menu');
    $('ul.header-menu-ul li').hover(function(){
        $(this).find('ul:first').slideDown(200);//显示二级菜单，括号中的数字表示下拉菜单完全显示出来需要200毫秒。
        $(this).addClass("hover");
    },function(){
        $(this).find('ul').css('display','none');
        $(this).removeClass("hover");
    });
    function hide_submenu(){
        $('ul.top-menu li').find('ul').css('display','none');
    }
    $('ul.top-menu li li:has(ul)').find("a:first").append(" &raquo; ");
    document.onclick = hide_submenu;
});
