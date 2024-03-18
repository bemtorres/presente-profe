function preview(e){
  if(e.files && e.files[0]){
    if (e.files[0].type.match('image.*')) {
    var reader=new FileReader();
    // El evento onload se ejecuta cada vez que se ha leido el archivo
    // correctamente
    reader.onload=function(e) {   
      document.getElementById("preview").innerHTML="<img src='"+e.target.result+"' class='Responsive image img-thumbnail' width='200px' height='200px' >";
    }
    // El evento onerror se ejecuta si ha encontrado un error de lectura
    reader.onerror=function(e) {
      document.getElementById("preview").innerHTML="Error de lectura";
    }
    // indicamos que lea la imagen seleccionado por el usuario de su disco duro
    reader.readAsDataURL(e.files[0]);
    }else{
    // El formato del archivo no es una imagen
    document.getElementById("preview").innerHTML="No es un formato de imagen";
    }
  }
}