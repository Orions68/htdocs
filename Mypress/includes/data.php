<?php
function getClient($conn, $client_id)
{
    $sql_client = "SELECT name FROM clients WHERE id='$client_id'";
    $stmt = $conn->prepare($sql_client);
    $stmt->execute();
    $row_client = $stmt->fetch(PDO::FETCH_OBJ);
    return $row_client->name;
}

function getService($conn, $service_id)
{
    $sql_service = "SELECT service FROM services WHERE id='$service_id'";
    $stmt = $conn->prepare($sql_service);
    $stmt->execute();
    $row_service = $stmt->fetch(PDO::FETCH_OBJ);
    return $row_service->service;
}
?>