$( window ).resize(function() {


    checkWidth();

});


$( document ).ready(function() {
    checkWidth();

    // $("#page").css({
    //     'width': ($("#edytor").width() + 'px')
    // });
    // $(".label-preview").css({
    //     'width': ($("#edytor").width() + 'px')
    // });
});


function checkWidth() {
    if($( window ).width()>=1199.98){

        //expanding text area
        $('textarea').each(function () {
            this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px;overflow-y:hidden;');
        }).on('input', function () {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });




        $("#buttons-left").removeClass("col-xl-8 col-md-10 col-sm-12 mx-auto");
        $("#buttons-right").removeClass("col-xl-8 col-md-10 col-sm-12 mx-auto");
        $("#text").removeClass("col-xl-8 col-md-10 col-sm-12 mx-auto");

        var itCanbe;

        $( window ).resize(function() {

            document.getElementById("buttons-left").style.transition=0;
            document.getElementById("buttons-right").style.transition=0;
            setPosition();

        });

        function setPosition(){
            var testDiv = document.getElementById("text").getBoundingClientRect();
            document.getElementById("buttons-left").style.left=(testDiv.left-200)+'px';

            var testDiv = document.getElementById("text").getBoundingClientRect();
            document.getElementById("buttons-right").style.left=(testDiv.right)+'px';
        }

        $(window).scroll(function() {
            var scroll = $(window).scrollTop();

            if (scroll >= 75) {
                $("#buttons-left").addClass("stickPos");
                $("#buttons-right").addClass("stickPos");
            }
            if (scroll < 75)
            {
                $("#buttons-left").removeClass("stickPos");
                $("#buttons-left").removeClass("stickPosNext");

                $("#buttons-right").removeClass("stickPos");
                $("#buttons-right").removeClass("stickPosNext");
            }
            if (scroll >= 150)
            {
                $("#buttons-left").removeClass("stickPos");
                $("#buttons-left").addClass("stickPosNext");

                $("#buttons-right").removeClass("stickPos");
                $("#buttons-right").addClass("stickPosNext");

            }

        });

        $( document ).ready(function() {
            setPosition();
        });


    }else{

        $("#buttons-left").addClass("col-xl-8 col-md-10 col-sm-12 mx-auto");
        $("#buttons-right").addClass("col-xl-8 col-md-10 col-sm-12 mx-auto");

    }
//wielkość ekranu

}