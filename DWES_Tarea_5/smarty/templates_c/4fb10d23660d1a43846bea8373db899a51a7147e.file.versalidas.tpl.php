<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-04 20:13:02
         compiled from ".\smarty\templates\versalidas.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2874954d26f3e73ec30-54686254%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4fb10d23660d1a43846bea8373db899a51a7147e' => 
    array (
      0 => '.\\smarty\\templates\\versalidas.tpl',
      1 => 1423076650,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2874954d26f3e73ec30-54686254',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'salidas' => 0,
    'salida' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d26f3e801503_83960605',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d26f3e801503_83960605')) {function content_54d26f3e801503_83960605($_smarty_tpl) {?><table>
    <thead>
        <tr>
            <td>Id</td>    
            <td>Nº Registro</td>    
            <td>Tipo de Documento</td>    
            <td>Fecha Salida</td>    
            <td>Remitente</td>    
            <td>Destinatario</td>    
            <td>Escaneado</td>    
        </tr>        
    </thead>    
    <tbody>
        <?php  $_smarty_tpl->tpl_vars['salida'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['salida']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['salidas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['salida']->key => $_smarty_tpl->tpl_vars['salida']->value) {
$_smarty_tpl->tpl_vars['salida']->_loop = true;
?>
            <tr>
                <td><?php echo $_smarty_tpl->tpl_vars['salida']->value['id'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['salida']->value['nregistro'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['salida']->value['tipodoc'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['salida']->value['fentrada'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['salida']->value['remitente'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['salida']->value['destinatario'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['salida']->value['escaneado'];?>
</td>                
            </tr>            
        <?php } ?>
    </tbody>
</table><?php }} ?>
