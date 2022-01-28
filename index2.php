<?php
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    //$usuario = $_GET['usuario'];
    //$password = $_GET['password'];

    echo 'El nombre de usuario era: '.$usuario .'<br>';
    echo 'La contraseña era: '.$password .'<br>';

    //ip, usuario, contraseña, BBDD
    $mysqli = new mysqli('127.0.0.1', 'Pruebas' , '1234', 'test'); 
    $mysqli -> query("SET NAMES UTF8"); //para que no de problemas en los acentos

//FORMA INCORRECTA: SUSPENSO AUTOMÁTICO
  //  $consulta_usuarios = $mysqli -> query(" SELECT * FROM usuarios 
  //                                          WHERE idUsuario='$usuario' 
  //                                          AND claveUsuario='$password' ");
  //
  //  $numero_usuarios = $consulta_usuarios->num_rows;
//  for ($i=0; $i < $consulta_usuarios->num_rows; $i++){
//    $r = $consulta_usuarios -> fetch_array(); 
//    echo $r['nombreUsuario']. ' último login: '.$r['ultimoLogin'].'<br>';
//}
    

 //FORMA CORRECTA: PREPARED STATEMENTS   

 $consulta_usuarios = $mysqli -> prepare(" SELECT * FROM usuarios 
                                           WHERE idUsuario= ? 
                                           AND claveUsuario= ? ");
 $consulta_usuarios = $mysqli -> bind_param("ss", $usuario, $password );
 $consulta_usuarios = $mysqli -> execute();
 $consulta_usuarios = $mysqli -> store_result();
 $consulta_usuarios = $mysqli -> bind_result($idUsuario, $nombreUsuario, $claveUsuario, $ultimoLogin );
 $consulta_usuarios = $mysqli -> fetch();                                        


    if ( $consulta_usuarios->num_rows > 0){
        echo $nombreUsuario. ' último login: '.$ultimoLogin.'<br>';
    }


    
