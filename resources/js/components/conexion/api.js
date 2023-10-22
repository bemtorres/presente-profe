// Importa la biblioteca Axios
// Función para realizar una solicitud GET
async function getData(url, endpoint) {
  try {
    const response = await axios.get(`${url}/${endpoint}`);
    return response.data;
  } catch (error) {
    console.error('Error en GET:', error);
  }
}

// Función para realizar una solicitud POST
export async function postData(url, data) {
  try {
    const response = await axios.post(url, data);
    return response.data;
  } catch (error) {
    console.error('Error en POST:', error);
  }
}

// Función para realizar una solicitud PUT
async function putData(url, endpoint, data) {
  try {
    const response = await axios.put(`${url}/${endpoint}`, data);
    return response.data;
  } catch (error) {
    console.error('Error en PUT:', error);
  }
}

// Función para realizar una solicitud DELETE
async function deleteData(url, endpoint) {
  try {
    const response = await axios.delete(`${url}/${endpoint}`);
    return response.data;
  } catch (error) {
    console.error('Error en DELETE:', error);
  }
}


// module.exports.getData = getData;
// module.exports.postData = postData;
// module.exports.putData = putData;
// module.exports.deleteData = deleteData;

// // Ejemplo de uso
// async function exampleUsage() {
//   const newData = { name: 'Nuevo elemento', description: 'Descripción del nuevo elemento' };

//   // Realizar una solicitud POST para crear un nuevo elemento
//   const createdItem = await postData('endpoint', newData);
//   console.log('Nuevo elemento creado:', createdItem);

//   // Realizar una solicitud GET para obtener elementos
//   const items = await getData('endpoint');
//   console.log('Elementos existentes:', items);

//   // Realizar una solicitud PUT para actualizar un elemento
//   const updatedData = { name: 'Nombre actualizado', description: 'Descripción actualizada' };
//   const updatedItem = await putData('endpoint/ID', updatedData);
//   console.log('Elemento actualizado:', updatedItem);

//   // Realizar una solicitud DELETE para eliminar un elemento
//   const deletedItem = await deleteData('endpoint/ID');
//   console.log('Elemento eliminado:', deletedItem);
// }

// // Llama a la función de ejemplo
// exampleUsage();
