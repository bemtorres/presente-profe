function descargarPDF(table,nombre) {
  var doc = new jsPDF();
  doc.autoTable({html: `#${table}`});
  doc.save( nombre+'.pdf');
}