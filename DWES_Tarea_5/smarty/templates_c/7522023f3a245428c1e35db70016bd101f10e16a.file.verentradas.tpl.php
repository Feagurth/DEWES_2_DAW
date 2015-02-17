<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-10 19:37:51
         compiled from ".\smarty\templates\verentradas.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1747354d039ef52ea78-02777453%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7522023f3a245428c1e35db70016bd101f10e16a' => 
    array (
      0 => '.\\smarty\\templates\\verentradas.tpl',
      1 => 1423588271,
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
<?php if ($_valid && !is_callable('content_54d039ef52ea73_33759592')) {function content_54d039ef52ea73_33759592($_smarty_tpl) {?><div class="listado">
    <h3>Registro de Entrada</h3>
    <table>
        <thead>
            <tr>
                <td>Nº Registro</td>    
                <td>Tipo</td>    
                <td>Fecha Entrada</td>    
                <td>Remitente</td>    
                <td>Destinatario</td>    
                <td>Escaneado</td>    
            </tr>        
        </thead>    
        <tbody>
            <?php  $_smarty_tpl->tpl_vars['entrada'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['entrada']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['entradas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['entrada']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['entrada']->key => $_smarty_tpl->tpl_vars['entrada']->value) {
$_smarty_tpl->tpl_vars['entrada']->_loop = true;
 $_smarty_tpl->tpl_vars['entrada']->iteration++;
?>
                <?php if (!($_smarty_tpl->tpl_vars['entrada']->iteration % 2)) {?>
                    <tr class="pijama1">
                <?php } else { ?>
                    <tr class="pijama2">
                <?php }?>
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
                    <td>
                        <?php if ($_smarty_tpl->tpl_vars['entrada']->value->getEscaneado()==="0") {?>
                            <img src='imagenes/no_file.png' alt='No hay fichero asociado al registro' title='No hay fichero asociado al registro'>
                        <?php } else { ?>
                            <img class="pointer"src='imagenes/view_file.png' alt='Hay ficheros asociados al registro' title='Hay ficheros asociados al registro' onclick="listarFichero(2, <?php echo $_smarty_tpl->tpl_vars['entrada']->value->getId();?>
);">
                        <?php }?>
                    </td>               
                </tr>            
            <?php } ?>
        </tbody>
    </table>
</div><?php }} ?>
