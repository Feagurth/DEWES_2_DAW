<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-06 14:07:29
         compiled from ".\smarty\templates\addsalida.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2383654d36d84629068-84209805%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '108302d464e54dd5e516ea2829ea62b68ceb2020' => 
    array (
      0 => '.\\smarty\\templates\\addsalida.tpl',
      1 => 1423228029,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2383654d36d84629068-84209805',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d36d84656cd4_32461894',
  'variables' => 
  array (
    'nreg' => 0,
    'fechaahora' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d36d84656cd4_32461894')) {function content_54d36d84656cd4_32461894($_smarty_tpl) {?><div id="nuevo_registro">
    <form id="form" action="index.php" method="post" enctype="multipart/form-data">
        <h3>Nuevo Registro de Salida</h3>
        <div>            
            Nº registro:&nbsp;<input type="text" id="nreg" name="nreg" readonly="1" value="<?php echo $_smarty_tpl->tpl_vars['nreg']->value;?>
"/>
            Remitente:&nbsp;<input type="text" id="remit" name="remit"/>
            Destinatario:&nbsp;<input type="text" id="dest" name="dest"/>
        </div>
        <div>
            Tipo Doc:&nbsp;&nbsp;&nbsp;<input type="text" id="tipodoc" name="tipodoc"/>                            
            Fecha:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="date" id="fsalida" name="fsalida" value="<?php echo $_smarty_tpl->tpl_vars['fechaahora']->value;?>
"/>              
        </div>
        <div>
            Escaneado: <input type="checkbox" id="esc" name="esc" onclick="mostrarOcultar(document.getElementById('esc').checked);" />&nbsp;&nbsp;
            <input type="file" id="addfile" name="addfile" readonly="1" value="" multiple="" />
        </div>              
        <div>
            <input type="submit" value="Insertar registro" title="Insertar registro" alt="Insertar registro">              
        </div>
     </form>
  </div>
<!-- Ejecutamos la función para ocultar el botón de añadir fichero al cargar 
la plantilla -->
<?php echo '<script'; ?>
>mostrarOcultar(document.getElementById('esc').checked);<?php echo '</script'; ?>
>
<?php }} ?>
