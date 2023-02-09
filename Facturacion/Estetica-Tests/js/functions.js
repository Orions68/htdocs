var valor = "";
var valor2 = "";

function add_service()
{
	var service = document.getElementById("service");
	var qtty = document.getElementById("qtty");
	var invoice = document.getElementById("invoice");
	var show = document.getElementById("servic");
	var factura = document.getElementById("factura");
	
	if (service.value !== "")
	{
		factura.style.visibility = "visible";
		valor += service.value + "," + qtty.value + ",";
		valor2 += service.value + " Cantidad: " + qtty.value + ", ";
		show.innerHTML = valor2;
		service.value = "";
		qtty.value = "1";
		invoice.value = valor;
	}
	else
	{
		toast(1, "No has Selecionado Servicio", "Antes de Tocar el Botón Agregar Servicio, Asegúrate de Seleccionar un Servicio y la Cantidad de los Desplegables.");
	}
}

function printIt(form)
{
	form.submit();
	var prtContent = document.getElementById("printable");
	var WinPrint = window.open('', '', '');
	WinPrint.document.write('<!DOCTYPE html><html><head><title>Imprimir Factura</title>');
	WinPrint.document.write('<link rel="stylesheet" type="text/css" href="css/style.css" />');
	WinPrint.document.write('</head><body>');
    WinPrint.document.write(prtContent.innerHTML);
    WinPrint.document.write('</body></html>');
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
    WinPrint.close();
}

function showAll()
{
	window.open("https://esteticajoana.000webhostapp.com/showtotal.php", "_blank");
}

function back_up()
{
	window.open("https://esteticajoana.000webhostapp.com/db-backup.php", "_blank");
	window.close();
}