<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-09 04:17:02
         compiled from ".\smarty\templates\visor.tpl" */ ?>
<?php /*%%SmartyHeaderCode:753054d7b608b4f966-91720301%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2b9dafe9bd68265bc33f4af24d942284f5681eff' => 
    array (
      0 => '.\\smarty\\templates\\visor.tpl',
      1 => 1423451821,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '753054d7b608b4f966-91720301',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d7b608bae008_02520196',
  'variables' => 
  array (
    'file' => 0,
    'filename' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d7b608bae008_02520196')) {function content_54d7b608bae008_02520196($_smarty_tpl) {?><div>
    <?php if (substr($_smarty_tpl->tpl_vars['file']->value['tipo'],-3)==='pdf') {?>
        <?php if ($_smarty_tpl->tpl_vars['filename']->value!='') {?>
            <object data="<?php echo $_smarty_tpl->tpl_vars['filename']->value;?>
" type="<?php echo $_smarty_tpl->tpl_vars['file']->value['tipo'];?>
" />
        <?php }?>
    <?php }?>
    <?php if (substr($_smarty_tpl->tpl_vars['file']->value['tipo'],-4)==='jpeg'||substr($_smarty_tpl->tpl_vars['file']->value['tipo'],-3)==='png'||substr($_smarty_tpl->tpl_vars['file']->value['tipo'],-3)==='gif') {?>
        <img src="data:<?php echo $_smarty_tpl->tpl_vars['file']->value['tipo'];?>
;base64,<?php echo base64_encode($_smarty_tpl->tpl_vars['file']->value['documento']);?>
" alt="<?php echo $_smarty_tpl->tpl_vars['file']->value['nombre'];?>
" />
    <?php }?>
    <?php if (substr($_smarty_tpl->tpl_vars['file']->value['tipo'],-12)==='octet-stream') {?>
        
    <?php }?>
  </object>
</div><?php }} ?>
