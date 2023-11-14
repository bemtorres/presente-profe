// Con array[]
export const addObjeto = (data, objeto) => {
  var existe = data.find((item) => item.id === objeto.id);
  if (!existe) {
    data.push(objeto);
  }
  return data;
};

export const findById = (data, id) => {
  var obj = data.find((item) => item.id === id);
  return obj || null;
};

export const updateById = (data, id, nuevoObjeto) => {
  var index = data.findIndex((item) => item.id === id);
  if (index !== -1) {
    data[index] = nuevoObjeto;
  }
  return data;
};

export const deleteById = (data, id) => {
  var index = data.findIndex((item) => item.id === id);
  if (index !== -1) {
    data.value.splice(index, 1);
  }
  return data;
};
