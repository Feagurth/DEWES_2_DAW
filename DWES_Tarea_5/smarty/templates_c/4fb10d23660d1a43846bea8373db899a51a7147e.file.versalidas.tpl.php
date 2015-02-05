<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-05 04:08:26
         compiled from ".\smarty\templates\versalidas.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2874954d26f3e73ec30-54686254%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4fb10d23660d1a43846bea8373db899a51a7147e' => 
    array (
      0 => '.\\smarty\\templates\\versalidas.tpl',
      1 => 1423105585,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2874954d26f3e73ec30-54686254',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d26f3e801503_83960605',
  'variables' => 
  array (
    'salidas' => 0,
    'salida' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d26f3e801503_83960605')) {function content_54d26f3e801503_83960605($_smarty_tpl) {?><div class="listado">
    <table>
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
 $_smarty_tpl->tpl_vars['salida']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['salida']->key => $_smarty_tpl->tpl_vars['salida']->value) {
$_smarty_tpl->tpl_vars['salida']->_loop = true;
 $_smarty_tpl->tpl_vars['salida']->iteration++;
?>
                <?php if (!($_smarty_tpl->tpl_vars['salida']->iteration % 2)) {?>
                    <tr class="pijama1">
                <?php } else { ?>
                    <tr class="pijama2">
                <?php }?>
                    <td><?php echo $_smarty_tpl->tpl_vars['salida']->value->getId();?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['salida']->value->getNreg();?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['salida']->value->getTipodoc();?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['salida']->value->getFecha();?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['salida']->value->getRemitente();?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['salida']->value->getDestinatario();?>
</td>
                    <td>
                        <?php if ($_smarty_tpl->tpl_vars['salida']->value->getEscaneado()==="0") {?>
                            <img src='imagenes/no_file.png' alt='No hay fichero asociado al registro' title='No hay fichero asociado al registro'>
                        <?php } else { ?>
                            <img src='imagenes/view_file.png' alt='Hay ficheros asociados al registro' title='Hay ficheros asociados al registro'>
                        <?php }?>
                    </td>                
                </tr>            
            <?php } ?>
        </tbody>
    </table>
</div><?php }} ?>
