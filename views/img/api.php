<?php

    /*=============================================
        TODO: Zona Horaria
    =============================================*/

    date_default_timezone_set('America/Lima');

    /*=============================================
        TODO: Mostrar errores
    =============================================*/

    ini_set('display_errors', 1);
    ini_set("log_errors", 1);
    // ini_set("error_log",  "D://xampp/htdocs/Proyecto_modular/server-angelamaria/php_error_log");

    /*=============================================
        TODO: CORS
    =============================================*/

    /* TODO: Permitir el acceso de otro origen */

    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('content-type: application/json; charset=utf-8');

    if(isset(getallheaders()["Authorization"]) || getallheaders()["Authorization"] == 'YJEntU7gJwbnqeukvXxnRgNzA3jg9Q'){

		/*=============================================
			TODO: Crear archivo en el servidor
		=============================================*/

		if(isset($_POST["src"]) && !empty($_POST["src"])){

            if(isset($_POST["name"]) && !empty($_POST["name"])){

                /*==============================================================================
                    TODO: Configuramos la ruta y el nombre de la imagen
                ==============================================================================*/

                $img_file = $_SERVER['DOCUMENT_ROOT'].'/views/img/dni_orders/'.$_POST["name"].'.png';

                /*==============================================================================
                    TODO: Almacenamos la imagen en base64
                ==============================================================================*/

                    $b64 = $_POST["src"];

                /*==============================================================================
                    TODO: Decodificamos la imagen en base64
                ==============================================================================*/

                    $bin = base64_decode($b64);

                /*==============================================================================
                    TODO: Creamos la imagen
                ==============================================================================*/

                    $im = imageCreateFromString($bin);

                /*==============================================================================
                    TODO: Verificamos que la imagen no este corrupta o no soportada
                ==============================================================================*/

                    if (!$im) {
                        die('Base64 value is not a valid image');
                    }

                /*==============================================================================
                    TODO: Guardamos la imagen
                ==============================================================================*/

                    imagepng($im, $img_file, 0);

                    $json = array(
                        'status' => 200,
                        'results' => "Se creo la imagen correctamente"
                    );

                    echo json_encode($json, http_response_code($json["status"]));

                    return;

                }
                else{
                    $json = array(
                        'status' => 400,
                        'results' => "Error no se envio el nombe de la imagen"
                    );

                    echo json_encode($json, http_response_code($json["status"]));

                    return;
                }
            }
            else{
                $json = array(
                    'status' => 400,
                    'results' => "Error no se envio la imagen"
                );
                echo json_encode($json, http_response_code($json["status"]));
                return;
            }

        }
        else{
            $json = array(
                'status' => 400,
                'results' => "Error de autorización"
            );
            echo json_encode($json, http_response_code($json["status"]));
            return;
    }

?>