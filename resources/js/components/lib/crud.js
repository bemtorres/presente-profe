export const agregarObjeto = (data, objeto) => {
  var existe = data.value.find((item) => item.id === objeto.id);

  if (!existe) {
    data.value.push(objeto);
    // return true; // Éxito
  }
  // return false; // El objeto ya existe
  return data;
};

export const buscarPorId = (data, id) => {
  var obj = data.value.find((item) => item.id === id);
  return obj || null;
};

export const actualizarPorId = (data, id, nuevoObjeto) => {
  var index = data.value.findIndex((item) => item.id === id);

  if (index !== -1) {
    data[index] = nuevoObjeto;
    // return true; // Éxito
  }

  // return false; // No se encontró el objeto
  return data;
};

export const eliminarPorId = (data, id) => {
  var index = data.value.findIndex((item) => item.id === id);

  if (index !== -1) {
    data.value.splice(index, 1);
    // return true; // Éxito
  }
  // return false; // No se encontró el objeto
  return data;
};
