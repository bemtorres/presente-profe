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
