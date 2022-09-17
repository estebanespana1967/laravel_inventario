<script>var Var_JavaScript = prompt("Introduce numero etiqueta");    // declaración de la variable </script>  
    <?php
        $var_PHP = "<script> document.writeln(Var_JavaScript); </script>"; // igualar el valor de la variable JavaScript a PHP 

    echo "Nombre: ".$var_PHP   // muestra el resultado 

    ?>


prueba
<?php
        $fecha1=$receta->fecha_recepcion;
        $fecha2=$receta->fecha_receta;
        $diferencia = abs((strtotime($fecha1) - strtotime($fecha2))/86400); 
        echo $fecha1,$fecha2,$diferencia;
?>

<script>var Var_JavaScript = prompt("Introduce numero etiqueta",$fecha1);    // declaración de la variable </script>  
    <?php
        $var_PHP = "<script> document.writeln(Var_JavaScript); </script>"; // igualar el valor de la variable JavaScript a PHP 

       
    echo "Nombre: ".$var_PHP   // muestra el resultado 

    ?>