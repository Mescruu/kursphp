var x = "x";
var currentOption = "";
var a;

function refreshImages(){ //Odczyt obrazków po wciśnięciu przycisku włączającego listę
        $.ajax({
            type: "get",
            url: "./phpfiles/getImages.php",
            cache: false,
            dataType: "JSON",
            success: function(paths){
                a = paths;
                pokazOpcje('obrazSrvr');
            }
          });
    }

$(document).on('change', ".imageUpload", function() { //Wrzucenie nowego obrazka
    var file_data = $('#image').prop('files')[0];
    var form_data = new FormData();
    form_data.append('image', file_data);
    $.ajax({
        url: './phpfiles/uploadImage.php', // point to server-side PHP script
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'POST',
        success: function(data){
            if(data.includes(" Błąd: ")){
                alert(data);
            } else{
                var path = "media/" + data;
                path = encodeURI(path);
                dodajObrazek(path);
            }

        }
    });
});


$(document).keyup(function(e) {
    if (e.key === "Escape") { // escape key maps to keycode `27`
        exitPage();
    }
});
function exitPage() {
    pokazOpcje('x');
    document.getElementById("formatted").classList.remove("show");
}

function dodajObrazek(val) {
    var text = "[img]" + val + "[/img]";
    var textarea = document.getElementById('text');
    insertAtCursor(textarea, text);
    pokazOpcje('x');
}

function dodajTabele(rows, cols) {
    var nb = document.getElementById("nb").checked;
    if(nb) var text = "[table=nb]";
    else var text = "[table]"
    var cell = "";
    var value = "";
    var k = 0;
    for (i = 0; i < rows; i++) {
        text += "[row]";
        for (j = 0; j < cols; j++) {
            cell = 'cell' + k.toString();
            value = document.getElementById(cell).value;
            text += "[col]" + value + "[/col]";
            k++;
        }
        text += "[/row]";
    }
    text += "[/table]";
    var textarea = document.getElementById('text');
    insertAtCursor(textarea, text);
    pokazOpcje('x');
}




function pokazOpcje(option) {


    if (option === 'x') {
        document.getElementById("frame").innerHTML = "";
        currentOption = "";
        document.getElementById("opcje").classList.remove("show");


    } else {
        document.getElementById("opcje").classList.add("show");


        if (currentOption !== option) {
            if (option === 'tabelaAdv') {
                var rows = parseInt(document.getElementById('rows').value, 10);
                var cols = parseInt(document.getElementById('cols').value, 10);
            }
            document.getElementById("frame").innerHTML = '<input type="button" class="btn-info" id="exit" value="x" onclick="pokazOpcje(' + x + ')">';
            switch (option) {
                case 'obraz':
                    currentOption = "obraz";
                    var obrazSrvr = "'obrazSrvr'"
                    document.getElementById("frame").innerHTML += '<h2>Wstaw obrazek</h2>';
                    document.getElementById("frame").innerHTML += '<div class="btn btn-left float-left">' +
                        '<span>Wstaw obraz z urządzenia</span>' +
                        '<label for="image" class="imageUpload" >\n' +
                        '    <i class="fa fa-cloud-upload"></i> Custom Upload\n' +
                        '</label>\n' +
                        '<input id="image" class="imageUpload"  type="file"/>'+
                        '</div>' +
                        '<div class="btn float-right btn-right">' +
                        '<span>Wstaw ostatnio dodany</span>' +
                        '<input type="button" class="imageGet" value="Wstaw ostatnio dodany" onclick="refreshImages();">' +
                        '</div>';
                    break;
                    
                case 'obrazSrvr':
                    currentOption = "obrazSrvr";
                    var obraz = "'obraz'"
                    document.getElementById("frame").innerHTML += '<h2>Wstaw obrazek</h2><input type="button"  class="btn btn-info btn-back" value="&#8629;" onclick="pokazOpcje(' + obraz + ');"></input>';

                    var path = "";


                    var imgText = '<div class="imgContainer">';
                    for (i = 0; i < a.length; i++) {
                        path = encodeURI(a[i]);
                        path = "'" + path + "'";
                        imgText += '<a onclick="dodajObrazek(' + path + ');" href="javascript:void(0);"><img src="' + a[i] + '" /></a>';
                    }
                    imgText += '</div>';

                    document.getElementById("frame").innerHTML += imgText;
                    break;
                    
                case 'tabela':
                    currentOption = "tabela";
                    var tabelaAdv = "'tabelaAdv'";
                    document.getElementById("frame").innerHTML += '<h2>Wstaw tabelę</h2> ' +
                        '  <div class="container">\n' +
                        '  <div class="row py-2 justify-content-center">\n' +
                        '    <label for="cols" class="col-left col-form-label">kolumny</label>\n' +
                        '    <div class="col-right">\n' +
                        '      <input type="text" id="cols">\n' +
                        '    </div>\n' +
                        '  </div>\n' +
                        '  <div class="row py-2 justify-content-center"">\n' +
                        '    <label for="rows" class="col-left col-form-label">wiersze</label>\n' +
                        '    <div class="col-right">\n' +
                        '      <input type="text" id="rows" >\n' +
                        '    </div>\n' +
                        '  </div>' +
                        '  <div class="row py-2 justify-content-center"">\n' +
                        '<input type="button" class="btn btn-info btn-zatwierdz" value="Zatwierdź" onclick="pokazOpcje(' + tabelaAdv + ')">'+
                        '  </div>' +
                        '  </div>';
                    break;
                    
                case 'tabelaAdv':
                    currentOption = "tabelaAdv";
                    var tabela = "'tabela'";
                    var htmlTable ='';
                    htmlTable+= '<h2>Wstaw tabelę</h2>' +
                        '<input type="button"  class="btn btn-info btn-back" value="&#8629;" onclick="pokazOpcje(' + tabela + ');"></input>'+
                        '<div class="tableContainer mx-auto"><table>';
                    if (rows > 0 && cols > 0) {
                        var k = 0;
                        for (i = 0; i < rows; i++) {
                            htmlTable+= '<tr>';
                            for (j = 0; j < cols; j++) {
                                htmlTable += '<td><input type="text" width="200px" id="cell' + k + '" style="margin: 10px"></td> ';
                                k++;
                            }
                            htmlTable+= '</tr>';
                        }
                        htmlTable+= '</table></div>' +
                            '<label class="container">' +
                            '  <input type="checkbox" value="Bez krawędzi" checked="checked" id="nb">\n' +
                            '  <span class="checkmark"></span>\n' +
                            '  <span class="text">Bez krawędzi</span>\n' +
                            '</label>';
                        htmlTable+= '<input type="button" value="Wstaw" class="btn btn-info btn-wstaw" onclick="dodajTabele(' + rows + ',' + cols + ')">';
                    } else
                        htmlTable+= 'Błędna ilość wierszy lub kolumn!';
                    document.getElementById("frame").innerHTML +=htmlTable;

                    break;
            }
        }
    }

}

function escapeHtml(text) {
    return text
            .replace(/&/g, "&amp")
            .replace(/</g, "&lt")
            .replace(/>/g, "&gt")
            .replace(/"/g, "&quot")
            .replace(/'/g, "&#039")
            .replace(/ /g, '\u00a0')
            .replace(/\t/g, '&nbsp;&nbsp;&nbsp;&nbsp;')
            .replace(/\n/g, '<br>');
}

function podglad() {
    var text = document.getElementById("text").value;
    text = escapeHtml(text);
    text = text.replace(/\[\-\]/g, '<hr>');
    text = text.replace(/\[\*\]/g, '&#9679'+'\u00a0');
    var html = '<div class="label-preview ">\n' +
        '                                <h2>Podgląd:</h2>\n'+
        '<input type="button" class="btn-info" id="exit" value="x" onclick="exitPage();"></input>'+
        '                            </div>' +
        '<div id="page" class="container-fluid">';

    html += bbcodeParser.bbcodeToHtml(text)+'</div>';

    document.getElementById("formatted").innerHTML = html;
    document.getElementById("formatted").classList.add("show");
}

function dodajBBCode(type)
{
    var bbcode = "";
    switch (type) {
        case "b":
            bbcode = "[b][/b]";
            break;
        case "i":
            bbcode = "[i][/i]";
            break;
        case "u":
            bbcode = "[u][/u]";
            break;
        case "center":
            bbcode = "[center][/center]";
            break;
        case "link":
            bbcode = "[link=][/link]";
            break;
        case "title":
            bbcode = "[title][/title]";
            break;
        case "stitle":
            bbcode = "[stitle][/stitle]";
            break;
        case "hr":
            bbcode = "[-]";
            break;
        case "code":
            bbcode = "[code][/code]";
            break;
        case "color":
            bbcode = "[color=COLOR][/color]";
            break;
        case "point":
            bbcode = "[*]";
            break;
    }
    var textarea = document.getElementById('text');
    insertAtCursor(textarea, bbcode);
}