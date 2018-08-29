 <?php
//initilize the page
require_once(SYSTEM_DIR . "/inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once(SYSTEM_DIR . "/inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Agregar Modelo";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
include(SYSTEM_DIR . "/inc/header.php");

//include left panel (navigation)
//follow the tree in inc/config.ui.php
//$page_nav["misc"]["sub"]["blank"]["active"] = true;
include(SYSTEM_DIR . "/inc/nav.php");
    if(isPost()){
        $u = new User();
        if(!$u->userExists($_POST['email']))
        {
            $u->addUser(getPost());
            informSuccess("Se ha guardado el registro",true,make_url("Users"),"ver/id");
        }
        else
        {
            $warning_message="Email already registered!";
        }

    }
?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
     <?php $breadcrumbs["Taller"] = APP_URL."/Catalogos/taller"; include(SYSTEM_DIR . "/inc/ribbon.php"); ?>
    <!-- MAIN CONTENT -->
    <div id="content">
        <div class="row">     
            <section id="widget-grid" class="">
                <article class="col-sm-12 col-md-6 col-lg-6"  id="">
                    <div class="jarviswidget  jarviswidget-sortables" id="wid-id-0"
                    data-widget-colorbutton="false" data-widget-editbutton="false" 
                    data-widget-deletebutton="false" data-widget-collapsed="false">
                        <!-- Widget ID (each widget will need unique ID)-->
                        <header>
                            <span class="widget-icon"> 
                                <i class="fa fa-plus"></i>
                            </span>
                            <h2><?php echo $page_title ?></h2>
                        </header>
                        <div style="display: ;">
                            <div class="jarviswidget-editbox" style=""></div>
                            <div class="widget-body">
                                <form action= "" method="POST" id="frmModelo">
                                    <div class="tl-body">
                                        <div class="col-sm-13">
                                            <div class="form-group">
                                                <label for="name">Submarca</label> 
                                                <input type="text" required class="form-control" placeholder="Capture Submarca" name="modelo" >
                                            </div>                            
                                            <div class="form-group">
                                                <label for="name">Marca</label><br>
                                                <select style="width:100%" class="select2" name="id_marca">
                                                    <option value="0">Seleccione una Marca</option>
                                                    <?php 
                                                        $obj = new Company();
                                                        $list=$obj->getAll();
                                                        if (is_array($list) || is_object($list)){
                                                            foreach($list as $val)
                                                                echo "<option value='".$val['id']."'>".$val['name']."</option>";
                                                        }
                                                    ?>
                                                </select>                                
                                            </div>
                                        </div>
                                        <div class="form-actions" style="text-align: center">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <button class="btn btn-default btn-md" type="button" onclick="window.history.go(-1); return false;">
                                                        Cancelar
                                                    </button>
                                                    <button class="btn btn-primary btn-md" type="button" onclick=" validateForm();">
                                                        <i class="fa fa-save"></i>
                                                        Guardar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </article>
            </section>
        </div>
    </div>
</div>
<!-- END MAIN PANEL -->
<!-- ==========================CONTENT ENDS HERE ========================== -->

<!-- PAGE FOOTER -->
<?php
    // include page footer
    include(SYSTEM_DIR . "/inc/footer.php");
?>
<!-- END PAGE FOOTER -->

<?php
    //include required scripts
    include(SYSTEM_DIR . "/inc/scripts.php");
?>

<!-- PAGE RELATED PLUGIN(S)
<script src="<?php echo ASSETS_URL; ?>/js/plugin/YOURJS.js"></script>-->

<script>
    function existadmin(email){
            if ( ! email ) return;
            if ( ! validateEmailStructure( email ) )
                return notify('warning', 'Email no es valido.');

            $.get(config.base+"/Users/Ajax/user?action=get&object=existadmin&email=" + email, null, function (response) {
                    if ( response == 1){
                        $("#email").val('');
                        notify('warning', 'Este email ya existe favor de intentar con otro');
                        return false;
                    }else{
                        return true;
                    }     
            });
        }
    function validateForm()
    {
        
        var email = $("#email").val();
        if (email == ""){ notify("info","Se necesita un email"); return false; }

        console.log(existadmin(email));

        
            var p1 = $("#password").val();
            var p2 = $("#confirmpassword").val();
            var x = $("#password").val();
            var espacios = false;
            var cont = 0;
            if (p1.length == 0 || p2.length == 0) {  notify('warning',"Se necesita un password"); return false;  }
                //ambas contraceñas coincidan
            if ( p1 != p2 ) { notify('warning',"El password no coincide"); return false; } 
        
            var x = $("#nombre").val();
            if (x == ""){ notify("warning","Se necesita un nombre"); return false; }
                
            var x = $("#apellido_pat").val();
            if (x == ""){ notify("warning","Se necesita un apellido"); return false; }
        
            $("#main-form").submit();       
    }
    $(document).ready(function() {
        
        $('body').on('change', '#email', function(){
                if( $(this).val() ){
                    var email = $("#email").val().trim();
                    existadmin(email);
                }
        });
        

        /* DO NOT REMOVE : GLOBAL FUNCTIONS!
         * pageSetUp() is needed whenever you load a page.
         * It initializes and checks for all basic elements of the page
         * and makes rendering easier.
         *
         */
         pageSetUp();

    })

</script>

<?php
    //include footer
    include(SYSTEM_DIR . "/inc/close-html.php");

?>