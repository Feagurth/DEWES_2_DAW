<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-19 05:06:24
         compiled from ".\smarty\templates\login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1276654e544781d8747-57030425%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e0f6b48d70c2f4906c7b095a57ba33a760f776da' => 
    array (
      0 => '.\\smarty\\templates\\login.tpl',
      1 => 1424318778,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1276654e544781d8747-57030425',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54e54478204221_53676980',
  'variables' => 
  array (
    'error' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54e54478204221_53676980')) {function content_54e54478204221_53676980($_smarty_tpl) {?><html id="login">
    <head>
        <title>Login</title>
        <link type = "text/css" rel = "stylesheet" href = "estilos.css"/>
    </head>
    <body>
        <div id="divlogin">
            <h3>Acceso de usuario</h3>
            <div>
                <input type="text" id="user" name="user" maxlength="16" placeholder="Introduzca el usuario"/>
            </div>
            <div>
                <input type="password" id="pass" name="pass" maxlength="16" placeholder="Introduzca la contraseña"/>
            </div>
            <div>
                <input type="button" id="submit" name="submit" value="Enviar" onclick="validarLogin();"/>
            </div>
            <div id="error">
                <p><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</p>
            </div>                               
        </div>
    </body>        
</html><?php }} ?>
