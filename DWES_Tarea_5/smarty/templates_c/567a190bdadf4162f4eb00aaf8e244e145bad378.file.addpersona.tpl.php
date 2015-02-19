<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-19 17:14:55
         compiled from ".\smarty\templates\addpersona.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2071754d8a666b3fb30-83432871%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '567a190bdadf4162f4eb00aaf8e244e145bad378' => 
    array (
      0 => '.\\smarty\\templates\\addpersona.tpl',
      1 => 1424200071,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2071754d8a666b3fb30-83432871',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d8a666b467f4_11524913',
  'variables' => 
  array (
    'personas' => 0,
    'persona' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d8a666b467f4_11524913')) {function content_54d8a666b467f4_11524913($_smarty_tpl) {?><div id="nueva_persona">
    <form id="form" name="personas" action="index.php" method="post" onsubmit="return validarEnvioPersona();">
        <h3>Registro de Personas</h3>
        <div>            
            Nombre:&nbsp;<input type="text" id="nombre" name="nombre"/>
            Primer Apellido:&nbsp;<input type="text" id="apellido1" name="apellido1"/>
            Segundo Apellido:&nbsp;<input type="text" id="apellido2" name="apellido2"/>
        </div>
        <div>            
            <input type="submit" value="Insertar Persona" title="Insertar Persona" alt="Insertar Persona">              
            <input type="hidden" value="5" name="nav" title="nav" />
        </div>
     </form>
</div>
<hr />
<div class="listado">
    <table>
        <thead>
            <tr>
                <td>Nombre</td>    
                <td>Primer Apellido</td>    
                <td>Segundo Apellido</td>    
                <td>&nbsp;</td>
            </tr>        
        </thead>    
        <tbody>
            <?php  $_smarty_tpl->tpl_vars['persona'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['persona']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['personas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['persona']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['persona']->key => $_smarty_tpl->tpl_vars['persona']->value) {
$_smarty_tpl->tpl_vars['persona']->_loop = true;
 $_smarty_tpl->tpl_vars['persona']->iteration++;
?>
                <?php if (!($_smarty_tpl->tpl_vars['persona']->iteration % 2)) {?>
                    <tr class="pijama1">
                <?php } else { ?>
                    <tr class="pijama2">
                <?php }?>
                    <td><?php echo $_smarty_tpl->tpl_vars['persona']->value->getNombre();?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['persona']->value->getApellido1();?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['persona']->value->getApellido2();?>
</td>
                    <td>
                        <img class="pointer"src='imagenes/user_delete.png' alt='Eliminar Persona' title='Eliminar Persona' onclick="eliminarPersona(<?php echo $_smarty_tpl->tpl_vars['persona']->value->getId_persona();?>
);">
                    </td>                                    
                </tr>      
                
            <?php } ?>
        </tbody>
    </table>    
</div>

<?php }} ?>
