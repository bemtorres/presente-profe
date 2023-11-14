
  {/* iziToast.settings({
    timeout: 3000,
    resetOnHover: true,
    transitionIn: 'flipInX',
    transitionOut: 'flipOutX',
    position: 'topRight',
    messageColor: 'white',
  }); */}

export const toastSuccess = (message) => {
  iziToast.success({
    backgroundColor: '#47c363',
    message,
  });
}

export const toastError = (message) => {
  iziToast.error({
    timeout: 0,
    backgroundColor: '#fc544b',
    message,
  });
}

export const toastWarning = (message) => {
  iziToast.warning({
    backgroundColor: '#ffa426',
    message,
  });
}

export const toastInfo = (message) => {
  iziToast.info({
    backgroundColor: '#3abaf4',
    message,
  });
}
