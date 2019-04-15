<?php
ob_start();

error_reporting(E_ALL); ini_set('display_errors', 1);

// Olny allow whitelisted IP durring testing
//$allow = array("192.168.56.1","171.66.214.130", "50.16.212.172", "50.242.118.102"); //allowed IPs
#if(!in_array($_SERVER['REMOTE_ADDR'], $allow) ){echo $_SERVER['REMOTE_ADDR'];echo $_SERVER['REMOTE_ADDR'];die; exit;}


// set global variables and load functions and classes
include_once("system/config/config.php");

// parse request
/*
For example if the URL is created with:
 make_url("TestSection","TestPage",array('sample_GET_Var_to_be_encrypted'=>'sample value','something'=>'else'));
 the URL will be:
 TestSection/TestPage/bbp_ucbCG6aPFTgj82cRloHBACOggZfiu7A_LBGjLMb2X6S_X3a1AYHVk3LLjAojL3qW__3f55dfed612c
 The result of unmake_url() will be:
Array
(
    [section] => TestSection
    [page] => TestPage
    [hashpass] => 1
    [path] => TestSection/TestPage
    [params] => Array
        (
            [sample_GET_Var_to_be_encrypted] => sample value
            [something] => else
        )
)
*/
$request=unmake_url();


//HOLA
//PRUEBA DE COMENTARIO EN BRANCH
/*
=====================================
Routing section
  maps requested URLs to pages and checks authorization
=====================================
*/
//$_SESSION['user_id']=1;
// Authorized user routing
    //if ( isset ($_SESSION['user_id']) && $_SESSION['user_id'] * 1 > 0 ){
    $dir="";
    if (isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0 ){
     // echo  "sesion=".$_SESSION['user_id'];

      //default page to load
      $page     = "Home_index.php";
      $page_num = 0;
      $page2    = ($request['page'])? $request['page'] : 'index';

    
     
      
      if ($request['section']==='Clientes'){
        $page = "Clientes_index.php";
        $dir  = "Clientes";
        if ($request['page']==='add')      { $page = "Clientes_add.php";      }
        if ($request['page']==='addpopup') { $page = "Clientes_adpopup.php";  }
        if ($request['page']==='edit')     { $page = "Clientes_edit.php";     }
      }

      if ( $request['section'] === 'Catalogos' ) {
        $page = "Catalogos_taller.php";
        $dir  = "Catalogos";
        if ($request['page'] === 'taller')         { $page = "Catalogos_taller.php"; }
        if ($request['page'] === 'submarca')       { $page = "Catalogos_submarca.php";  }
        if ($request['page'] === 'marca')          { $page = "Catalogos_marca.php";  }
        if ($request['page'] === 'aseguradora')    { $page = "Catalogos_aseguradora.php";  }
        if ($request['page'] === 'servicio')       { $page = "Catalogos_servicio.php";  }
        if ($request['page'] === 'paquete')        { $page = "Catalogos_paquete.php";  }
        if ($request['page'] === 'serviciopaquete'){ $page = "Catalogos_serviciopaquete.php";  }
        if ($request['page'] === 'refaccion')      { $page = "Catalogos_refaccion.php";  }
        if ($request['page'] === 'proveedor')      { $page = "Catalogos_proveedor.php";  }
        if ($request['page'] === 'almacen')        { $page = "Catalogos_almacen.php";  }
        if ($request['page'] === 'gastostipo')     { $page = "Catalogos_gastostipo.php";  }
        if ($request['page'] === 'personalpuesto') { $page = "Catalogos_personalpuesto.php";  }
      }
      if ($request['section']==='Users'){
        $page = "Users_index.php";
        $dir  = "Users";

        if ($request['page']==='show') { $page = "Users_show.php"; }
        if ($request['page']==='add')  { $page = "Users_add.php" ; }
        if ($request['page']==='edit') { $page = "Users_edit.php"; }
        
      }
      if ($request['section']==='Vehiculos'){
        $page="Vehiculos_index.php";
        $dir="Vehiculos";
        if ($request['page']==='add') { $page = "Vehiculos_add.php"; }
        if ($request['page']==='edit'){ $page = "Vehiculos_edit.php"; }
        if ($request['page']==='view'){ $page = "Vehiculos_view.php"; }
      }
      if ($request['section']==='Permisos'){
        $page = "Permisos_index.php";
        $dir  = "Permisos";
        if ($request['page']==='add')    { $page = "Permisos_add.php"; }
        if ($request['page']==='edit')   { $page = "Permisos_edit.php"; }
        if ($request['page']==='asignar'){ $page = "Permisos_asignar.php"; }
      }
      if ($request['section']==='Pedidos'){
        $page = "Pedidos_index.php";
        $dir  = "Pedidos";
        if ($request['page']==='add')   { $page = "Pedidos_add.php"; }
        if ($request['page']==='edit')  { $page = "Pedidos_edit.php"; }
        if ($request['page']==='view')  { $page = "Pedidos_view.php"; }
      }
      if ($request['section']==='Inventarios'){
        $page = "Inventarios_index.php";
        $dir  = "Inventarios";
        if ($request['page']==='kardex')   { $page = "Inventarios_kardex.php"; }
      } 
      if ($request['section']==='Personal'){
        $page = "Personal_index.php";
        $dir  = "Personal";
        if ($request['page']==='add')      { $page = "Personal_add.php";      }
        if ($request['page']==='edit')     { $page = "Personal_edit.php";     }
      }
      if ($request['section']==='Gastos'){
        $page = "Gastos_index.php";
        $dir  = "Gastos";
        if ($request['page']==='add')      { $page = "Gastos_add.php";      }
        if ($request['page']==='edit')     { $page = "Gastos_edit.php";     }
        if ($request['page']==='view')     { $page = "Gastos_view.php";     }
      }
      if ($request['section']==='Nomina'){
        $page = "Nomina_index.php";
        $dir  = "Nomina";
        if ($request['page']==='add')      { $page = "Nomina_add.php";      }
        if ($request['page']==='edit')     { $page = "Nomina_edit.php";     }
        if ($request['page']==='view')     { $page = "Nomina_view.php";     }
      }
      if ($request['section']==='Reportes'){
        $page = "Reportes_index.php";
        $dir  = "Reportes";
        if ($request['page']==='add')      { $page = "Reportes_gastos.php";      }
      }
    
      //*****permisos de usuario  */***///
      if($request['section']!='Home' && $request['section']!='Examples' && $request['page']!="" && $request['page']!="ajax" && $request['page']!="print" ){
        $objpermuser = new PermisoUser();
        $datapermuser  = $objpermuser->getpermisouser($_SESSION['user_id'],$request['section'],$page2);
        if ( !$datapermuser ) {
          echo "ERROR permisos".$_SESSION['user_id']."------".$request['section']."-----".$page2;
          informPermiss(true,make_url("Home","index"));
        }
      }
      
      //delete pages
      if(isset($request['params']['id'])){
        if( $id = $request['params']['id'] ) {
          $table = explode("delete", $request['page']);
         
          if(count($table)>1){
            delete($id,$request['section'],$table[0]);
          }
        }
      }
      //end delete
           /******  DEV ROUTING  ******/
      $request['page']=($request['page'])? $request['page']: 'index';
      
      if (file_exists("system/pages/".$dir."/".$request['section']."_".$request['page'].".php")){
        $page = $dir."/".$request['section']."_".$request['page'].".php";
        
      }elseif(file_exists($dir."/system/pages/".$request['section']."_index.php")){
        $page = $dir."/".$request['section']."_index.php";
        
      }elseif(file_exists("system/pages/".$request['section']."_index.php")){
        $page = $request['section']."_index.php";
        
      }else{}

      
      /***/


    }else{
      // Unauthenticated user
      // go to login page
      
        $page="Login_index.php";
        switch ($request['section']) {
          case 'Login':
            $dir="";
            if ($request['page']==='ResetPassword' ){$page="Login_ResetPassword.php";}
            if ($request['page']==='ChangePassword' ){$page="Login_ChangePassword.php";}
            break;
          case 'Register':
            $page="Register_index.php";
            if ($request['section']==='Register' ){
                $page="Register_index.php";
                $dir="";
            }
            break;
          case 'Clientes':
            if ($request['page']==='addpopup'){
              $dir  = "Clientes";
              $page = "Clientes_adpopup.php";      
            }
            break;
          case 'Vehiculos':            
            if ($request['page']==='print'){ 
              $dir  = "Vehiculos"; 
              $page = "Vehiculos_print.php";      
            }
            break;
          default:
            
            break;
        }
       
        #die;
        if($dir)  $page = $dir."/".$page;

        
    }
   
// Public user
//echo "========session=".$_SESSION['user_id']."<pre>".print_r(unmake_url())."</pre>";
if( isset($request['path']) && preg_match("/\.php$/",$request['path']) && file_exists(  ROOT_DIR . "/1_example_pages/" . $request['path'])){
  //echo ROOT_DIR . "/1_example_pages/" . $request['path'];

  include_once(ROOT_DIR . "/1_example_pages/" . $request['path']);
}elseif (file_exists("system/pages/".$page)){
 
  include_once("system/pages/".$page);
}else{}

// close database
if (!$db->connect_errno) {
   // $db->close();
}
ob_end_flush();
