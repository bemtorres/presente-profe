export const formatFecha = (fecha) => {
  const partes = fecha.split('-');
  if (partes.length === 3) {
    const [anio, mes, dia] = partes;
    return `${dia}-${mes}-${anio}`;
  }
  return fecha;
}

export const formatFechas = (fechas) => {
  const fechasConvertidas = fechas.map((fecha) => {
    return formatFecha(fecha);
  });

  return fechasConvertidas;
}

export const calcularFechasSiguientes = (f) => {
  const fechaObj = new Date(f);
  const fechas = [formatFecha(f)];

  for (let i = 1; i <= 5; i++) {
    fechaObj.setDate(fechaObj.getDate() + 1);
    const fsiguiente = fechaObj.toISOString().split('T')[0];
    fechas.push(formatFecha(fsiguiente));
  }

  return fechas;
}

// {id: 'X-1', dia: 'X', modulo: '1', estado: 1, color: 'verde'}
// viene el arreglo de los modulos con sus horario [11:00, 12:00]
// viene el arreglo de las fechas [2020-10-10, 2020-10-11]
export const convertirFechaCodigo = (data, modulos, fechas) => {
  const semanas = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"];
  const meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
  const dias = ["L", "M", "X", "J", "V", "S"];

  const n = dias.findIndex((d) => d === data.dia);
  let dia = semanas[n];
  let modulo = modulos[data.modulo - 1];

  let fecha = fechas[n];

  let fecha2 = fecha.split('-');
  fecha2 = fecha2[0] + ' de ' + meses[fecha2[1] - 1] + ' del ' + fecha2[2];
  // try {
  //   fecha2 = format(new Date(fecha), 'dd \'de\' MMMM \'del\' yyyy', { locale: es });
  //   console.log("convertirFechaCodigo FECHA->", fecha2);
  // } catch (error) {
  //   console.log("error",error);
  // }

  let info = {
    dia: dia,
    hora: modulo[0] + ' - ' + modulo[1],
    modulo: data.modulo,
    fecha: fecha,
    fecha2: fecha2
  };

  return info;
}


export const orderFecha = (data) => {
  const ordenDias = ["L", "M", "X", "J", "V", "S"];

  data.sort((a, b) => {
    const diaA = ordenDias.indexOf(a.dia);
    const diaB = ordenDias.indexOf(b.dia);

    // Si los días son diferentes, ordena por día
    if (diaA !== diaB) {
      return diaA - diaB;
    }

    // Si los días son iguales, ordena por módulo
    return parseInt(a.modulo) - parseInt(b.modulo);
  });

  return data;
}
