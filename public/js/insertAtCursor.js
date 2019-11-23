function insertAtCursor(myField, selectedText, bbcode1, bbcode2) {
    //IE support
    if (document.selection) {
        myField.focus();
        sel = document.selection.createRange();
        sel.text = bbcode1 + selectedText + bbcode2;
    }
    // Microsoft Edge
    else if (window.navigator.userAgent.indexOf("Edge") > -1) {
        var startPos = myField.selectionStart;
        var endPos = myField.selectionEnd;

        myField.value =
                myField.value.substring(0, startPos)
                + bbcode1
                + selectedText
                + bbcode2
                + myField.value.substring(endPos, myField.value.length);

        var pos;
        if(startPos === endPos){
            pos = startPos + bbcode1.length;
        }else{
            pos = startPos + (bbcode1 + selectedText + bbcode2).length;
        }
        myField.focus();
        myField.setSelectionRange(pos, pos);
    }
    //MOZILLA and others
    else if (myField.selectionStart || myField.selectionStart === 0) {
        var startPos = myField.selectionStart;
        var endPos = myField.selectionEnd;
        myField.value =
                myField.value.substring(0, startPos)
                + bbcode1
                + selectedText
                + bbcode2
                + myField.value.substring(endPos, myField.value.length);
        var pos;
        if(startPos === endPos){
            pos = startPos + bbcode1.length;
        }else{
            pos = startPos + (bbcode1 + selectedText + bbcode2).length;
        }
        myField.focus();
        myField.setSelectionRange(pos, pos);
    } else {
        myField.value += +bbcode1 + selectedText + bbcode2;
    }
}