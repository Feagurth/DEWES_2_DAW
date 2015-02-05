<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-05 15:06:39
         compiled from ".\smarty\templates\addsalida.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2383654d36d84629068-84209805%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '108302d464e54dd5e516ea2829ea62b68ceb2020' => 
    array (
      0 => '.\\smarty\\templates\\addsalida.tpl',
      1 => 1423144925,
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
    'fechaahora' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d36d84656cd4_32461894')) {function content_54d36d84656cd4_32461894($_smarty_tpl) {?><div id="nuevo_registro">
      <form id="form" action="index.php" method="post" enctype="multipart/form-data">
          <div>
              <h3>Nuevo Registro de Salida</h3>
              Nº registro: <input type="text" id="nreg" name="nreg" readonly="1" value=""/>
              Tipo Doc:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="tipodoc" name="tipodoc"/>
              Fecha:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="date" id="fsalida" name="fsalida" value="<?php echo $_smarty_tpl->tpl_vars['fechaahora']->value;?>
"/>
          </div>
          <div>
              Remitente:&nbsp;&nbsp;<input type="text" id="remit" name="remit"/>
              Destinatario: <input type="text" id="dest" name="dest"/>
              Escaneado: <input type="checkbox" id="esc" name="esc" onclick="mostrarOcultar(document.getElementById('esc').checked);" />&nbsp;&nbsp;
              <input type="file" id="addfile" name="addfile" readonly="1" value="" />
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
