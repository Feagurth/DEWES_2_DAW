<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-19 01:53:56
         compiled from ".\smarty\templates\mostrarerror.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2215854e52361ac02e9-47775509%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2aabb087df503d118b066dae4c30fab3bde2bcf1' => 
    array (
      0 => '.\\smarty\\templates\\mostrarerror.tpl',
      1 => 1424307232,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2215854e52361ac02e9-47775509',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54e52361bb7fb8_10059034',
  'variables' => 
  array (
    'error' => 0,
    'emailadmin' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54e52361bb7fb8_10059034')) {function content_54e52361bb7fb8_10059034($_smarty_tpl) {?><div id='mostrarerror'>
    <h3>No se ha podido realizar la petición solicitada</h3>
    <p>Código: <?php echo $_smarty_tpl->tpl_vars['error']->value->getCode();?>
</p>
    <p>Informacion: <?php echo $_smarty_tpl->tpl_vars['error']->value->getMessage();?>
</p>    
    <p>Pongase en contacto con el administrador en la siguiente dirección: <?php echo $_smarty_tpl->tpl_vars['emailadmin']->value;?>
</p>
    <p><a href="mailto:<?php echo $_smarty_tpl->tpl_vars['emailadmin']->value;?>
?subject=Error App Entradas-Salidas&body=%0A%0A%0A%0ACódigo de Error: <?php echo $_smarty_tpl->tpl_vars['error']->value->getCode();?>
%0AMensaje de Error: <?php echo $_smarty_tpl->tpl_vars['error']->value->getMessage();?>
">O pulse este enlace para enviar un mail con el error</a></p>
</div><?php }} ?>
