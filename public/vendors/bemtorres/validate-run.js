function validarRut(string) {
  var out = '';
  var filtro = '1234567890Kk';
  for (var i = 0; i < string.length; i++)
    if (filtro.indexOf(string.charAt(i)) != -1)
    out += string.charAt(i).toUpperCase();
  return out;
}
