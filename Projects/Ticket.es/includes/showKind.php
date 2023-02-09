<?php // Esta función se llama desde index.php cuando busco los eventos por tipo.
if (isset($_POST["kind"])) // Si recibe datos en $_POST["kind"].
{
    $kind = $_POST["kind"]; // Asigna el POST a la variable $kind
    echo "<script>document.getElementById('kind').value = '$kind'</script>"; // En Javascript asigno al selector con id kind el valor en $kind, pongo en el selector lo que seleccioné.
    echo '<form action="event.php" method="post">'; // Creo un formulario que llamará al script event.php.
    echo "<input type='hidden' name='kind' value='$kind'>"; // Creo un input type hidden con el nombre kind y el valor de $kind.
    echo '<label><select name="place" required>'; // Creo un selector con el nombre place.
    echo '<option>Selecciona el Lugar</option>'; // Agrego un option pidiendo que se seleccione un lugar.
    $stmt = $conn->prepare("CALL Busqueda_X_Tipo('$kind')"); // Llamo al procedimiento Busqueda_X_Tipo pasandole la variable $kind.
    $stmt->execute(); // Ejecuto la consulta a la base de datos.
    if ($stmt->rowCount() > 0) // Si hay resultados.
    {
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) // Mientras reciba resultados los asigno a la variable $row.
        {
            echo "<option value='" . $row->place . "'>" . $row->place . "</option>"; // Creo options con los resultados
        }
        echo '</select> Selecciona el Lugar Donde Quieres Ver el Evento</label>'; // Se cierra el select y la etiqueta muestra la leyenda Selecciona el Lugar...
        echo "<br><br>"; // Pongo dos saltos de línea
        echo '<input type="submit" value="Ver que Hay">'; // Agrego el input tipo submit para enviar el formulario.
        echo "</form>"; // Cierro el formulario.
    }
    else // Si no hubo resultados.
    {
        echo "<script>toast(1, 'Sin Eventos aun:', 'Aun no se ha Publicado Nada, Vuelve Pronto Para Ver los Nuevos Eventos.');</script>"; // Muestro el diálogo, No hay datos aun.
    }
}
?>