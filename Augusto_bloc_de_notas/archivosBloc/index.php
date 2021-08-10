<?php
    $directorio = $_GET['directorio'];
?>
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloc de Notas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

</head>

<body class="d-flex flex-column h-100">
    <header>
        <h1 class="text-center">BLOC DE NOTAS EN PHP</h1>
    </header>
    <main>
        <div class="container">
            <form enctype="multipart/form-data" id="formulario" method="POST">
                <label class="form-label">Nombre del archivo:</label>
                <div class="row g-3">
                    <div class="col-auto">
                        <input class="form-control" id="nombre-archivo" type="text" name="nombre-archivo">
                    </div>
                    <div class="col-auto" style="margin: 0px !important; padding: 20px 5px 5px 5px !important;">
                        <label class="form-label" for="nombre-archivo" style="margin: 0px !important; font-size:25px !important;">.txt</label>
                    </div>
                    <div class="col-auto">
                        <input class="btn btn-success" value="Buscar" type="button" onclick="buscar();">
                    </div>
                </div>
                <br>
                <textarea class="form-control" id="texto-archivo" name="texto-archivo" style="resize: none;" rows="10" cols="50"></textarea><br>
                <input class="btn btn-success" value="Crear" type="button" onclick="crear();">
                <input class="btn btn-success" value="Actualizar" type="button" onclick="actualizar();">
                <input class="btn btn-success" value="Limpiar" type="reset">
                <input class="btn btn-danger" value="Eliminar" type="button" onclick="eliminar();">
            </form>
        </div>
        <div class="container py-3">
            <table class="table caption-top" id="list_planogramas">
                <caption>Lista de archivos dentro de la carpeta: (<?php echo $directorio?>)</caption>
                <tr>
                    <th scope="col"><center>Archivo</center></th>
                    <th scope="col"><center>Enlace de descarga</center></th>
                </tr>
            <?php
                require "./listar_archivos.php";
            ?>
            </table>

            <button class="btn btn-success"><a href="../directorios/index.php" style="text-decoration: none; color:white">Regresar</a></button>
            
        </div>
    </main>
    <footer class='footer mt-auto py-3 bg-light'>
        </div>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <script>
        function crear() {
            $.ajax({
                type: 'POST',
                url: 'crear_archivo.php?directorio=<?php echo $directorio?>',
                data: $('#formulario').serialize(),
                success: function(respuesta) {
                    if (respuesta) {
                        alert(respuesta);
                    } else {
                        alert('Archivo creado correctamente. Actualizar la pagina para ver los cambios');
                    }
                }
            });
        }

        function actualizar() {
            $.ajax({
                type: 'POST',
                url: 'guardar_archivo.php?directorio=<?php echo $directorio?>',
                data: $('#formulario').serialize(),
                success: function(respuesta) {
                    if (respuesta == "Archivo no existe...") {
                        alert('Error en la edicion del archivo. No existe');
                    } else {
                        alert("Archivo actualizado con exito. Actualice la pagina para ver los cambios");
                    }
                }
            });
        }

        function buscar() {

            $.ajax({
                type: 'POST',
                url: 'cargar_archivo.php?directorio=<?php echo $directorio?>',
                data: $('#formulario').serialize(),
                success: function(contenido) {
                    if(contenido == "No se encontró el archivo"){
                        alert("Archivo no encontrado");
                    }else{  
                        $('#texto-archivo').val(contenido);                        
                    }
                    }
                
            });
        }

        function eliminar() {
            $.ajax({
                type: 'POST',
                url: 'eliminar_archivo.php?directorio=<?php echo $directorio?>',
                data: $('#formulario').serialize(),
                success: function(contenido) {
                    if (contenido == "ok") {
                        alert("Se ha eliminado el archivo. Actualice la pagina para ver los cambios");
                    } else {
                        alert('Archivo no encontrado');
                    }
                }
            });
        }
    </script>
</body>

</html>