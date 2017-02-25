$(function() {
    console.log("JQuery is runnning.");
    resizeSplashContainer();
    resizeSplashImage();
    resizeMainContainer();

    $(".navigation-header").click(function(){
        $(".navigation-option").css("display", "none");
        if ($(this).hasClass("show")) {
            $(this).removeClass("show");
        } else {
            $(".navigation-header").removeClass("show");
            $(this).addClass("show");
            $(this).parent().find(".navigation-option").css("display", "block");
        }
    });

    console.log($(".navigation-option:last-child").length);
})

function resizeMainContainer() {
    $(".main-container").css("height", 
            $(window).height() + "px");
}

function resizeSplashContainer() {
    var height = $(window).height() / 2;
    $(".splash-container").css("height", height + "px");
}

function resizeSplashImage() {
    var height = $(window).height() / 2;
    var width = $(window).width()
    $(".splash-image").css("height", height + "px");
    $(".splash-image").css("width", width + "px");
}