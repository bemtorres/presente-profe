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
