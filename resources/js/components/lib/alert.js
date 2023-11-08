export const alertSuccess = (title, message) => {
  Swal.fire({
    title: title,
    text: message,
    icon: "success"
  });
}

export const alertSuccessTime = (title, message) => {
  Swal.fire({
    title: title,
    text: message,
    icon: "success",
    timer: 3000, // Define el tiempo en milisegundos (3 segundos en este ejemplo)
    timerProgressBar: true,
    willClose: () => {
      window.location.reload();
    }
  });
}

export const alertError = (title, message) => {
  Swal.fire({
    title: title,
    text: message,
    icon: "error"
  });
}

export const alertWarning = (title, message) => {
  Swal.fire({
    title: title,
    text: message,
    icon: "warning"
  });
}

export const alertInfo = (title, message) => {
  Swal.fire({
    title: title,
    text: message,
    icon: "info",
    confirmButtonColor: '#04243c',
    confirmButtonText: 'Aceptar',
  });
}
