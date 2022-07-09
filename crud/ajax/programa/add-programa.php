<?php
include('../../../functions/connection.php');

if (isset($_POST['titulo']) && isset($_FILES['archivo']) && isset($_POST['descripcion']) && isset($_POST['telefono'])) {
    $id_programa = NULL;
    $titulo = trim(mysqli_real_escape_string($mysqli, $_POST['titulo']));
    $archivo = trim(mysqli_real_escape_string($mysqli, $_FILES["archivo"]["name"]));
    $descripcion = mysqli_real_escape_string($mysqli, $_POST['descripcion']);
    $telefono = mysqli_real_escape_string($mysqli, $_POST['telefono']);

    $size = 1024 * 1024 * 10;

    if ($_FILES["archivo"]['size'] < $size) {
        $carpeta = 'img-programa/';
        $tipo = $_FILES['archivo']['type'];
        $tipoNombre = $_FILES['archivo']['name'];
        $info = new SplFileInfo($tipoNombre);
        $infoExtension = $info->getExtension();
        $fechaArchivo = date('Ymd-His');

        if ($tipo == "image/png") {
            $archivoNombre = $carpeta . $fechaArchivo . ".png";
        } else if ($tipo == "image/jpeg") {
            $archivoNombre = $carpeta . $fechaArchivo . ".jpg";
        }

        $archivo = $archivoNombre;

        if (!file_exists($archivo)) {
            $sql = "INSERT INTO programas(id_programa, titulo, imagen_programa,descripcion,celular) VALUES ('$id_programa','$titulo','$archivo','$descripcion','$telefono')";
            $resultado = $mysqli->query($sql);

            if ($resultado) {
                if (move_uploaded_file($_FILES['archivo']['tmp_name'], $archivo)) {
                    echo "exito";
                } else {
                    echo "Error en el archivo";
                }
            } else {
                echo "Fallo en la insercion";
            }
        } else {
            echo "El archivo ya existe";
        }
    } else {
        echo "El archivo excede el tamaño permitido de 10mb";
    }
} else {
    echo "Error en el envio, revisa que los campos y el documento esten bien seleccionados";
}

?>