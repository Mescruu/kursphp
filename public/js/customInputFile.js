function showname () {
    var name = document.getElementById('fileInput');
    document.getElementById('name').innerHTML=name.files.item(0).name;
    document.getElementById('size').innerHTML=Math.round(name.files.item(0).size/1024)/100+"MB";
};