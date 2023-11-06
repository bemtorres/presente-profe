export const alertSuccess = (title, message) => {
  Swal.fire({
    title: title,
    text: message,
    icon: "success"
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
