    <?php

    $server = "localhost";
    $user = "root";
    $pass = "";
    $bd = "inventario";

    //Creamos la conexión
    $conexion = mysqli_connect($server, $user, $pass, $bd)
        or die("Ha sucedido un error inesperado en la conexion de la base de datos");

    //generamos la consulta
    $sql = "SELECT * FROM cdinventory";
    $result = $conexion->query($sql);
    // $result = $mysqli->query($sql);
    mysqli_set_charset($conexion, "utf8"); //formato de datos utf8

    if (!$result = mysqli_query($conexion, $sql)) die();

    while ($row = mysqli_fetch_array($result)) {
        $title = $row['title'];
        $artist = $row['artist'];
        $country = $row['country'];
        $company = $row['company'];
        $price = $row['price'];
        $titleyear = $row['titleyear'];
        $imagen = $row['imagen'];
        $available = $row['available'];


        $cds[] = array(
            'title' => $title, 'artist' => $artist, 'country' => $country, 'company' => $company,
            'price' => $price, 'titleyear' => $titleyear, 'imagen' => $imagen, 'available' => $available
        );
    }

    //desconectamos la base de datos
    $close = mysqli_close($conexion)
        or die("Ha sucedido un error inesperado en la desconexion de la base de datos");
    $file = 'mycds.json';
    // $json_string = json_encode($cds);
    // file_put_contents($file, $json_string);


    //Creamos el JSON
    echo json_encode($cds);



    ?>