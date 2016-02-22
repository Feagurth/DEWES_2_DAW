<?php /* Smarty version 3.1.23, created on 2016-01-18 18:15:24
         compiled from "./smarty/templates/visor.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:9751569d1dac7d4710_91494359%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ff304f70dcc3d39e0dad35a95a8a6a60487481aa' => 
    array (
      0 => './smarty/templates/visor.tpl',
      1 => 1424349489,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9751569d1dac7d4710_91494359',
  'variables' => 
  array (
    'file' => 0,
    'filename' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.23',
  'unifunc' => 'content_569d1dac8ee5d8_57836503',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_569d1dac8ee5d8_57836503')) {
function content_569d1dac8ee5d8_57836503 ($_smarty_tpl) {
?>
<?php
$_smarty_tpl->properties['nocache_hash'] = '9751569d1dac7d4710_91494359';
?>
<div>
    <?php if (substr($_smarty_tpl->tpl_vars['file']->value['tipo'],-3)==='pdf') {?>
        <?php if ($_smarty_tpl->tpl_vars['filename']->value!='') {?>
            <object data="<?php echo $_smarty_tpl->tpl_vars['filename']->value;?>
" type="<?php echo $_smarty_tpl->tpl_vars['file']->value['tipo'];?>
" />
        <?php }?>
    <?php }?>
    <?php if (substr($_smarty_tpl->tpl_vars['file']->value['tipo'],-4)==='jpeg'||substr($_smarty_tpl->tpl_vars['file']->value['tipo'],-3)==='png'||substr($_smarty_tpl->tpl_vars['file']->value['tipo'],-3)==='gif'||substr($_smarty_tpl->tpl_vars['file']->value['tipo'],-3)==='bmp') {?>
        <img src="data:<?php echo $_smarty_tpl->tpl_vars['file']->value['tipo'];?>
;base64,<?php echo base64_encode($_smarty_tpl->tpl_vars['file']->value['documento']);?>
" alt="<?php echo $_smarty_tpl->tpl_vars['file']->value['nombre'];?>
" />
    <?php }?>
    <?php if (substr($_smarty_tpl->tpl_vars['file']->value['tipo'],-12)==='octet-stream') {?>
        
    <?php }?>
  </object>
</div><?php }
}
?>