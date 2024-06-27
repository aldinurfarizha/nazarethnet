$('.chat-left-inner > .chatonline').slimScroll({
    height: '100%',
    position: 'right',
    size: "0px",
    color: '#dcdcdc',

});
 $(function(){
    $(window).load(function(){
        $('.chat-list').css({'height':(($(window).height())-470)+'px'});
    });
    $(window).resize(function(){
        $('.chat-list').css({'height':(($(window).height())-470)+'px'});
    });
    });

$(function() {
    $(window).load(function() {
        $('.chat-left-inner').css({
            'height': (($(window).height()) - 240) + 'px'
        });
    });
    $(window).resize(function() {
        $('.chat-left-inner').css({
            'height': (($(window).height()) - 240) + 'px'
        });
    });
});


$(".open-panel").on('click',function() {
    $(".chat-left-aside").toggleClass("open-pnl");
    $(".open-panel i").toggleClass("ti-angle-left");
});

