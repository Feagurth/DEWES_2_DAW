<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-08 06:02:05
         compiled from ".\smarty\templates\ficheros.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2325354d6cd6eb33745-58551087%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1558cbaba471cedb480f9b9aff20701bf326dffa' => 
    array (
      0 => '.\\smarty\\templates\\ficheros.tpl',
      1 => 1423371658,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2325354d6cd6eb33745-58551087',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d6cd6eb9c5b7_22365211',
  'variables' => 
  array (
    'docs' => 0,
    'doc' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d6cd6eb9c5b7_22365211')) {function content_54d6cd6eb9c5b7_22365211($_smarty_tpl) {?><div>
    <?php  $_smarty_tpl->tpl_vars['doc'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['doc']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['docs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['doc']->key => $_smarty_tpl->tpl_vars['doc']->value) {
$_smarty_tpl->tpl_vars['doc']->_loop = true;
?>
        <?php if (substr($_smarty_tpl->tpl_vars['doc']->value['tipo'],-3)==='pdf') {?>
            <p><img src='imagenes/pdf.png' ><?php echo $_smarty_tpl->tpl_vars['doc']->value['nombre'];?>
</p>
        <?php }?>            
        <?php if (substr($_smarty_tpl->tpl_vars['doc']->value['tipo'],-4)==='jpeg'||substr($_smarty_tpl->tpl_vars['doc']->value['tipo'],-3)==='png') {?>            
            <p><img src='imagenes/pic.png' ><?php echo $_smarty_tpl->tpl_vars['doc']->value['nombre'];?>
</p>
        <?php }?>
        <?php if (substr($_smarty_tpl->tpl_vars['doc']->value['tipo'],-12)==='octet-stream') {?>
            <p><img src='imagenes/file.png' ><?php echo $_smarty_tpl->tpl_vars['doc']->value['nombre'];?>
</p>
        <?php }?>                                    
    <?php } ?>      

</div>
<?php }} ?>
