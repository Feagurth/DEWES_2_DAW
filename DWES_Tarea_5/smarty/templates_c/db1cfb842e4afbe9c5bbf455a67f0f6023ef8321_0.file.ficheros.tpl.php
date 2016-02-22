<?php /* Smarty version 3.1.23, created on 2016-01-18 18:15:22
         compiled from "./smarty/templates/ficheros.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:19094569d1daab4f003_73717416%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'db1cfb842e4afbe9c5bbf455a67f0f6023ef8321' => 
    array (
      0 => './smarty/templates/ficheros.tpl',
      1 => 1424349497,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19094569d1daab4f003_73717416',
  'variables' => 
  array (
    'docs' => 0,
    'doc' => 0,
    'nav' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.23',
  'unifunc' => 'content_569d1dab175bb1_04204258',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_569d1dab175bb1_04204258')) {
function content_569d1dab175bb1_04204258 ($_smarty_tpl) {
?>
<?php
$_smarty_tpl->properties['nocache_hash'] = '19094569d1daab4f003_73717416';
?>
<div>    
    <?php
$_from = $_smarty_tpl->tpl_vars['docs']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['doc'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['doc']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['doc']->value) {
$_smarty_tpl->tpl_vars['doc']->_loop = true;
$foreachItemSav = $_smarty_tpl->tpl_vars['doc'];
?>
        <?php if (substr($_smarty_tpl->tpl_vars['doc']->value['tipo'],-3)==='pdf') {?>
            <div><img src='imagenes/pdf.png' alt="<?php echo $_smarty_tpl->tpl_vars['doc']->value['nombre'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['doc']->value['nombre'];?>
" onclick="mostrarFichero(<?php echo $_smarty_tpl->tpl_vars['nav']->value;?>
, <?php echo $_smarty_tpl->tpl_vars['doc']->value['id_registro'];?>
, <?php echo $_smarty_tpl->tpl_vars['doc']->value['id_documento'];?>
);"><p title="<?php echo $_smarty_tpl->tpl_vars['doc']->value['nombre'];?>
"><?php echo $_smarty_tpl->tpl_vars['doc']->value['nombre'];?>
</p></div>
        <?php }?>            
        <?php if (substr($_smarty_tpl->tpl_vars['doc']->value['tipo'],-4)==='jpeg'||substr($_smarty_tpl->tpl_vars['doc']->value['tipo'],-3)==='png'||substr($_smarty_tpl->tpl_vars['doc']->value['tipo'],-3)==='gif'||substr($_smarty_tpl->tpl_vars['doc']->value['tipo'],-3)==='bmp') {?>
            <div><img src='imagenes/pic.png' alt="<?php echo $_smarty_tpl->tpl_vars['doc']->value['nombre'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['doc']->value['nombre'];?>
" onclick="mostrarFichero(<?php echo $_smarty_tpl->tpl_vars['nav']->value;?>
, <?php echo $_smarty_tpl->tpl_vars['doc']->value['id_registro'];?>
, <?php echo $_smarty_tpl->tpl_vars['doc']->value['id_documento'];?>
);"><p title="<?php echo $_smarty_tpl->tpl_vars['doc']->value['nombre'];?>
"><?php echo $_smarty_tpl->tpl_vars['doc']->value['nombre'];?>
</p></div>
        <?php }?>
        <?php if (substr($_smarty_tpl->tpl_vars['doc']->value['tipo'],-12)==='octet-stream') {?>
        <div><img src='imagenes/file.png' alt="<?php echo $_smarty_tpl->tpl_vars['doc']->value['nombre'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['doc']->value['nombre'];?>
" onclick="descargarFichero(<?php echo $_smarty_tpl->tpl_vars['doc']->value['id_documento'];?>
);"><p title="<?php echo $_smarty_tpl->tpl_vars['doc']->value['nombre'];?>
"><?php echo $_smarty_tpl->tpl_vars['doc']->value['nombre'];?>
</p></div>
        <?php }?>                                    
    <?php
$_smarty_tpl->tpl_vars['doc'] = $foreachItemSav;
}
?>      
    
</div>
<?php }
}
?>