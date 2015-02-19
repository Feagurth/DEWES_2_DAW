<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-18 21:23:33
         compiled from ".\smarty\templates\showerror.tpl" */ ?>
<?php /*%%SmartyHeaderCode:682554e4e5bc74c5a1-28640501%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '654d85a3423bb3b2a64ecec3fca8401ff47af5d2' => 
    array (
      0 => '.\\smarty\\templates\\showerror.tpl',
      1 => 1424291005,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '682554e4e5bc74c5a1-28640501',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54e4e5bc75cc64_38884746',
  'variables' => 
  array (
    'emailadmin' => 0,
    'error' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54e4e5bc75cc64_38884746')) {function content_54e4e5bc75cc64_38884746($_smarty_tpl) {?><div id='mostrarerror'>
    <h3>No se ha podido realizar la petición solicitada</h3>
    <p>Pongase en contacto con el administrador en la siguiente dirección</p>
    <a href="mailto:<?php echo $_smarty_tpl->tpl_vars['emailadmin']->value;?>
?subject=Error App Entradas-Salidas&body=%0A%0A%0A%0ACódigo de Error: <?php echo $_smarty_tpl->tpl_vars['error']->value->getCode();?>
%0AMensaje de Error: <?php echo $_smarty_tpl->tpl_vars['error']->value->getMessage();?>
">Pulse este enlace para enviar un mail con el error</a> 
    <p>Código: <?php echo $_smarty_tpl->tpl_vars['error']->value->getCode();?>
</p>
    <p>Informacion: <?php echo $_smarty_tpl->tpl_vars['error']->value->getMessage();?>
</p>
</div><?php }} ?>
