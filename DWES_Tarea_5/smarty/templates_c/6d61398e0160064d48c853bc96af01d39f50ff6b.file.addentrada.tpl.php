<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-05 15:05:55
         compiled from ".\smarty\templates\addentrada.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2754554d3633776a1b4-30768154%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6d61398e0160064d48c853bc96af01d39f50ff6b' => 
    array (
      0 => '.\\smarty\\templates\\addentrada.tpl',
      1 => 1423144917,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2754554d3633776a1b4-30768154',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d363378aa8b5_36092757',
  'variables' => 
  array (
    'fechaahora' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d363378aa8b5_36092757')) {function content_54d363378aa8b5_36092757($_smarty_tpl) {?><div id="nuevo_registro">
      <form id="form" action="index.php" method="post" enctype="multipart/form-data">
          <div>
              <h3>Nuevo Registro de Entrada</h3>
              Nº registro: <input type="text" id="nreg" name="nreg" readonly="1" value=""/>
              Tipo Doc:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="tipodoc" name="tipodoc"/>
              Fecha:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="date" id="fentrada" name="fentrada" value="<?php echo $_smarty_tpl->tpl_vars['fechaahora']->value;?>
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
