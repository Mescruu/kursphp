let input = document.getElementById("startValue").value;
let clickCount = 0;
checkWeight(document.getElementById("typ").value);

function checkWeight(newVal) {

    if(newVal=="kolokwium")
    {
        document.getElementById("weight").classList.remove("d-none");
        document.getElementById("confirm").classList.remove("col-3");
        document.getElementById("confirm").classList.add("col-2");
    }
    else{
        document.getElementById("weight").classList.add("d-none");
        document.getElementById("confirm").classList.remove("col-2");
        document.getElementById("confirm").classList.add("col-3");
    }
}

function warning() {
    if(clickCount==0){
        window.confirm('Po zmniejszeniu zostaną usunięte pytania!');
        clickCount++;
    }
}

function setInputs(value) {

    if(value<=input){
        for(let i=1;i<=input;i++)
        {
            if(i>value){
                removeInputs(i);
            }
        }
    }
    else{

        for(let i=1;i<=value;i++)
        {
            if(i>input){
                create(i);
            }
        }

    }


    input=value;
}

function removeInputs(id) {
    var elem = document.getElementById('pytanie'+id);
    elem.parentNode.removeChild(elem);
    return false;
}
function create(id) {

    document.getElementById('pytania').innerHTML += '' +
        '  <div class="form-group " id="pytanie'+id+'">\n' +
        '\n' +
        '                                <div class="row">\n' +
        '                                    <div class="col-12">\n' +
        '                                        <div class="card text-dark bg-light mb-3 row-eq-height w-100">\n' +
        '                                            <div class="card-header"><h3>Pytanie '+id+'.</h3></div>\n' +
        '                                            <div class="card-body">\n' +
        '\n' +
        '                                                <textarea type="text" class="form-control" name="tresc'+id+'" ></textarea>\n' +
        '\n' +
        '                                            </div>\n' +
        '                                        </div>\n' +
        '                                    </div>\n' +
        '                                </div>\n' +
        '                                <div class="row"> <!-- <div class="row no-gutters"> opakowanie dla kolumn/ no-gutters wylacza odstepy/paddingi pionowe pomiedzy kolumnami-->\n' +
        '                                    <div class="col-12 col-sm-6 col-md-3 ">\n' +
        '                                        <div class="card text-dark bg-light mb-3 row-eq-height w-100">\n' +
        '                                            <div class="card-header"><h3>A</h3></div>\n' +
        '                                            <div class="card-body">\n' +
        '                                                <p class="card-text">Odpowiedź poprawna</p>\n' +
        '\n' +
        '                                                <textarea type="text" class="form-control" name="odpPoprawna'+id+'"></textarea>\n' +
        '\n' +
        '\n' +
        '                                            </div>\n' +
        '                                        </div>\n' +
        '                                    </div>\n' +
        '                                    <div class="col-12 col-sm-6 col-md-3 ">\n' +
        '                                        <div class="card text-dark bg-light mb-3 row-eq-height w-100">\n' +
        '                                            <div class="card-header"><h3>B</h3></div>\n' +
        '                                            <div class="card-body">\n' +
        '                                                <p class="card-text">Odpowiedź a.</p>\n' +
        '\n' +
        '                                                <textarea type="text" class="form-control" name="odpA'+id+'" > </textarea>\n' +
        '\n' +
        '                                            </div>\n' +
        '                                        </div>\n' +
        '                                    </div>\n' +
        '                                    <div class="col-12 col-sm-6 col-md-3 ">\n' +
        '                                        <div class="card text-dark bg-light mb-3 row-eq-height w-100">\n' +
        '                                            <div class="card-header "><h3>C</h3></div>\n' +
        '                                            <div class="card-body">\n' +
        '                                                <p class="card-text">Odpowiedź b.</p>\n' +
        '\n' +
        '                                                <textarea type="text" class="form-control" name="odpB'+id+'" > </textarea>\n' +
        '\n' +
        '                                            </div>\n' +
        '                                        </div>\n' +
        '                                    </div>\n' +
        '                                    <div class="col-12 col-sm-6 col-md-3 ">\n' +
        '                                        <div class="card text-dark bg-light mb-3 row-eq-height w-100">\n' +
        '                                            <div class="card-header"><h3>D</h3></div>\n' +
        '                                            <div class="card-body">\n' +
        '                                                <p class="card-text">Odpowiedź c.</p>\n' +
        '\n' +
        '                                                <textarea type="text" class="form-control" name="odpC'+id+'"> </textarea>\n' +
        '\n' +
        '                                            </div>\n' +
        '                                        </div>\n' +
        '                                    </div>\n' +
        '                                </div>\n' +
        '                            </div>';
    return false;
}