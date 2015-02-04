<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-04 22:01:11
         compiled from ".\smarty\templates\verentradas.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1747354d039ef52ea78-02777453%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7522023f3a245428c1e35db70016bd101f10e16a' => 
    array (
      0 => '.\\smarty\\templates\\verentradas.tpl',
      1 => 1423083624,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1747354d039ef52ea78-02777453',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d039ef52ea73_33759592',
  'variables' => 
  array (
    'entradas' => 0,
    'entrada' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d039ef52ea73_33759592')) {function content_54d039ef52ea73_33759592($_smarty_tpl) {?><table>
    <thead>
        <tr>
            <td>Id</td>    
            <td>Nº Registro</td>    
            <td>Tipo de Documento</td>    
            <td>Fecha Entrada</td>    
            <td>Remitente</td>    
            <td>Destinatario</td>    
            <td>Escaneado</td>    
        </tr>        
    </thead>    
    <tbody>
        <?php  $_smarty_tpl->tpl_vars['entrada'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entrada']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['entradas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['entrada']->key => $_smarty_tpl->tpl_vars['entrada']->value) {
$_smarty_tpl->tpl_vars['entrada']->_loop = true;
?>
            <tr>
                <td><?php echo $_smarty_tpl->tpl_vars['entrada']->value->getId();?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['entrada']->value->getNreg();?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['entrada']->value->getTipodoc();?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['entrada']->value->getFecha();?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['entrada']->value->getRemitente();?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['entrada']->value->getDestinatario();?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['entrada']->value->getEscaneado();?>
</td>                
            </tr>            
        <?php } ?>
    </tbody>
</table>
<?php }} ?>
