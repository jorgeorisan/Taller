<?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");
 
if (  isset($_GET["action"]) && $_GET["object"]){

	switch ($_GET["object"]) {
		case 'getcliente':
			if( isset($_GET["id"]) ){
				$u = new Cliente();
				if($res=$u->getTable($_GET['id'])){
					$data="<table border=1 style=' border-color: #CCC;'><tr  align='center'><td colspan='2'><h4>Datos del Cliente</h4></td></tr>";
					echo $data.="<tr>
									<td><strong>Nombre:</strong></td>
									<td>" . $res["nombre"] ." ".$res["apellido_pat"] ." ".$res["apellido_mat"] . "</td>
								</tr>
								<tr>
									<td><strong>Email:</strong></td><td>"   .$res["email"]     . "</td>
								</tr>
								<tr>
									<td><strong>Telefono:</strong></td><td>" .$res["telefono"] . "</td>
								</tr>
								<tr><td><strong>Direccion:</strong></td><td>" .$res["ciudad"]." ".$res["estado"]. " Col." .$res["colonia"] ." Call." .$res["calle"]." ".$res["num_ext"]. " " .$res["num_int"]."</td>
								</tr>
							</table>";
				}else{
					echo 0;
				}
			}else{
				echo 0;
			}
			break;
		case 'getsubmarca':
			if( isset($_GET["id"]) ){
				$obj = new SubMarca();
				if($list=$obj->getAllbyid($_GET["id"])){
					$data='<select style="width:100%" class="select2" name="id_submarca" id="id_submarca">
								<option value="">Selecciona Modelo</option>';
                        if (is_array($list) || is_object($list)){
                            foreach($list as $val){
                                $data.="<option value='".$val['id']."'>".$val['nombre']."</option>";
                            }
                        }
                         
                    echo $data.='</select>';
				}else{
					echo 0;
				}
			}else{
				echo 0;
			}
			break;
		
		default:
			# code...
			break;
	}
	
}

?>