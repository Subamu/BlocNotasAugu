<?php
        //Creamos Nuestra Función
        function lista_archivos($carpeta)
        {
            $direccionamiento = explode("/", $carpeta); //La función recibira como parametro un carpeta
            if (is_dir($carpeta)) { //Comprovamos que sea un carpeta Valido
                if ($dir = opendir($carpeta)) { //Abrimos el carpeta
                    
                    while (($archivo = readdir($dir)) !== false) { //Comenzamos a leer archivo por archivo
                        if ($archivo != '.' && $archivo != '..') {
                            $nuevaRuta = $carpeta . $archivo . '/';
                            echo '<tr><td>'; //Abrimos un elemento de lista 
                            if (is_dir($nuevaRuta)) { //Si la ruta que creamos es un carpeta entonces:
                                echo '<b>' . $nuevaRuta . '</b>'; //Imprimimos la ruta completa resaltandola en negrita
                                lista_archivos($nuevaRuta); //Volvemos a llamar a este metodo para que explore ese carpeta.
                            } else { //si no es un carpeta:
                                echo $archivo; //simplemente imprimimos el nombre del archivo actual
                            }
                            echo '</td><td><center><a class="btn btn-success" role="button" href="descargar_archivo.php?directorio='.$direccionamiento[2].'&file='. $archivo .'">Descargar</a></center></td></tr>'; //Cerramos el item actual y se inicia la llamada al siguiente archivo
                        }
                    } //finaliza 
                    closedir($dir); //Se cierra el archivo
                }
            } else { //Finaliza el If de la linea 12, si no es un carpeta valido, muestra el siguiente mensaje
                echo 'No Existe la carpeta';
            }
        } //Fin de la Función	 
        //Llamamos a la función
            lista_archivos("../directorios/$directorio/");
            
        ?>