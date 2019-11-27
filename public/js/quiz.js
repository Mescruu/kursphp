


function showall() {


    $("#pytania").show(500);
}

let last=0

function hide(obj) {
    $("#"+obj).hide(500);

    var newValue = parseInt(obj.replace('pytanie', ''));
    newValue++;


    if ($('#pytanie'+newValue).length > 0) {
        show("pytanie"+newValue);
    }
    else{

        show('results');
        last=newValue;
    }

}
function start(){
    $("#hello").hide(500);
    show('pytanie1');
}

function show(obj){
    $("#"+obj).show(500);
}

