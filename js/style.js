
function validate(){    
  
    var inp = document.getElementById('fileToUpload');
    if(inp.files.length === 0){
        alert("Atleast one image is required");
        inp.focus();

        return false;
    } else {
        document.getElementById('submit').style.display = 'none';
        document.getElementById('loader').style.display = 'block';
        var form = document.getElementById('resizer-form');
        form.submit();
        form.reset();
        
        return false;
    }
    
}

var click = 0;
var limit = 4;
function addMore() {
    click += 1;
    var htmlToInsert = 
        '<div class = "form-group my-2" id="newButton'+ click +'">'+
            '<div class="row mx-0"><input style="width:75%;" class = "form-control-file" type = "file" name = "fileToUpload[]" id = "fileToUpload">' +
            '<span style="width:20%;" class="btn btn-sm btn-outline-danger" onclick="return(removeThis(this));">remove</span></div>' +
        '</div>';

    if (click <= limit){
        document.getElementById('fileToUpload').insertAdjacentHTML("afterend", htmlToInsert);
    } else {
        alert('Only ' + (limit + 1) + ' images are allowed at a time');
    }
        
}

function removeThis(node) {
    node.parentNode.parentNode.remove();
    click -= 1;
}