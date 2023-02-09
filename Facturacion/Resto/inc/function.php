<?php
function result($conn, $row, $where, $how) // Función result recibe la conexión, las filas de la base de datos $row y un 1 o un 0 para saber de donde se llama.
{
    global $table, $client, $wait, $price, $partial, $product, $qtty;
    $eacharticle = [];
    if ($how == 0)
    {
        $table = $row["tabl"];
        $client = $row["client"];
        $client = getClient($conn, $client);
        $wait = $row["wait_id"];
        $qttyArray = explode(",", $row["qtty"]);
        $productArray = explode(",", $row["article"]);
        $partialArray = explode(",", $row["partial"]);
    }
    else
    {
        $table = $row->tabl;
        $client = $row->client;
        $client = getClient($conn, $client);
        $wait = $row->wait_id;
        $qttyArray = explode(",", $row->qtty);
        $productArray = explode(",", $row->article);
        $partialArray = explode(",", $row->partial);
    }
    if ($wait == 0)
    {
        $wait = "Fonda 13";
    }
    else
    {
        $sql = "SELECT name FORM wait WHERE id=$wait";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        $wait = $row->name;
    }
    for ($i = 0; $i < count($productArray) - 1; $i++)
    {
        $eacharticle[$i] = explode(":", $productArray[$i]);
        if ($i == count($productArray) - 2)
        {
            $qtty .= $qttyArray[$i];
            $partial .= $partialArray[$i] . " $";
        }
        else
        {
            if ($where == 1) // Si $where es 1, se llamo desde la tabla HTML.
            {
                $qtty .= $qttyArray[$i] . "<br>";
                $partial .= $partialArray[$i] . " $<br>";
            }
            else // Si no es 1 se llamo desde la plantilla de Excel.
            {
                $qtty .= $qttyArray[$i] . "\n";
                $partial .= $partialArray[$i] . " $\n";
            }
        }
    }

    for ($i = 0; $i < count($productArray) - 1; $i++)
    {
        $sql_product = "SELECT food, food_price FROM foods WHERE id=" . $eacharticle[$i][1];
        $stmt = $conn->prepare($sql_product);
        $stmt->execute();
        $row_product = $stmt->fetch(PDO::FETCH_OBJ);
        $product_name = $row_product->food;
        $product_price = $row_product->food_price;
        if ($i == count($productArray) - 2)
        {
            $product .= $product_name;
            $price .= number_format((float)$product_price, 2, ',', '.') . " $";
        }
        else
        {
            if ($where == 1) // Si $where es 1, se llamo desde la tabla HTML.
            {
                $product .= $product_name . "<br>"; // Saltos de línea HTML.
                $price .= number_format((float)$product_price, 2, ',', '.') . " $<br>";
            }
            else // Si no es 1 se llamo desde la plantilla de Excel.
            {
                $product .= $product_name . "\n"; // Saltos de línea \n.
                $price .= number_format((float)$product_price, 2, ',', '.') . " $\n";
            }
        }
    }
}

function getClient($conn, $name)
{
    if ($name == 0)
    {
        return "Consumidor Final";
    }
    else
    {
        $sql = "SELECT name FROM delivery WHERE id=$name";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        return $row->name;
    }
}
?>