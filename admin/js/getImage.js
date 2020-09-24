function getImage(e) {
    var imageName = document.getElementById("inputImage").value;

    imageName = imageName.split("\\")[2];
    var image = document.getElementById("image");

    if(imageName != undefined) {
        image.innerHTML = ''+imageName+'';
    } else {
        image.innerHTML = 'Insira uma imagem válida';
    }
}