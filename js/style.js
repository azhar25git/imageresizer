function validate(){
    var inp = document.getElementById('fileToUpload');
    if(inp.files.length === 0){
        alert("Attachment Required");
        inp.focus();

        return false;
    }
}