<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-10 19:14:59
         compiled from ".\smarty\templates\addentrada.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2754554d3633776a1b4-30768154%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6d61398e0160064d48c853bc96af01d39f50ff6b' => 
    array (
      0 => '.\\smarty\\templates\\addentrada.tpl',
      1 => 1423588271,
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
    'nreg' => 0,
    'personas' => 0,
    'persona' => 0,
    'fechaahora' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d363378aa8b5_36092757')) {function content_54d363378aa8b5_36092757($_smarty_tpl) {?><div id="nuevo_registro">
    <form id="form" action="index.php" method="post" enctype="multipart/form-data" onsubmit="return validarEnvioRegistro();">
        <h3>Nuevo Registro de Entrada</h3>
        <div>            
            Nº registro:&nbsp;<input type="text" id="nreg" name="nreg" readonly="1" value="<?php echo $_smarty_tpl->tpl_vars['nreg']->value;?>
"/>
            Remitente:&nbsp;
            <select id="remit" name="remit">
                <?php  $_smarty_tpl->tpl_vars['persona'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['persona']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['personas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['persona']->key => $_smarty_tpl->tpl_vars['persona']->value) {
$_smarty_tpl->tpl_vars['persona']->_loop = true;
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['persona']->value->getId_persona();?>
"><?php echo $_smarty_tpl->tpl_vars['persona']->value->getNombre();?>
 <?php echo $_smarty_tpl->tpl_vars['persona']->value->getApellido1();?>
 <?php echo $_smarty_tpl->tpl_vars['persona']->value->getApellido2();?>
</option>
                <?php } ?>
            </select>
            Destinatario:&nbsp;
            <select id="dest" name="dest">
                <?php  $_smarty_tpl->tpl_vars['persona'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['persona']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['personas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['persona']->key => $_smarty_tpl->tpl_vars['persona']->value) {
$_smarty_tpl->tpl_vars['persona']->_loop = true;
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['persona']->value->getId_persona();?>
"><?php echo $_smarty_tpl->tpl_vars['persona']->value->getNombre();?>
 <?php echo $_smarty_tpl->tpl_vars['persona']->value->getApellido1();?>
 <?php echo $_smarty_tpl->tpl_vars['persona']->value->getApellido2();?>
</option>
                <?php } ?>
            </select>
            
        </div>
        <div>
            Tipo Doc:&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="tipodoc" name="tipodoc" maxlength="15"/>                            
            Fecha:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="date" id="fecha" name="fecha" value="<?php echo $_smarty_tpl->tpl_vars['fechaahora']->value;?>
"/>              
        </div>
        <div>
            Escaneado: <input type="checkbox" id="esc" name="esc" onclick="mostrarOcultar(document.getElementById('esc').checked);" />&nbsp;&nbsp;
            <!-- Añadimos multiple="" y definimos el nombre con corchetes como un array al input tipo file para permitir la selección de multiples ficheros -->
            <input type="file" id="addfile" name="addfile[]" readonly="1" value="" multiple="" />
        </div>              
        <div>            
            <input type="submit" value="Insertar registro" title="Insertar registro" alt="Insertar registro">              
            <input type="hidden" value="1" name="nav" title="nav" />
        </div>
     </form>
  </div>
<!-- Ejecutamos la función para ocultar el botón de añadir fichero al cargar 
la plantilla -->
<?php echo '<script'; ?>
>mostrarOcultar(document.getElementById('esc').checked);<?php echo '</script'; ?>
>
<?php }} ?>
