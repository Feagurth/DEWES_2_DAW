<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-04 20:22:16
         compiled from ".\smarty\templates\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1835754be5b09811e20-23647140%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '574dee0eb4e1f2028170052ff5213936dc4c1acb' => 
    array (
      0 => '.\\smarty\\templates\\index.tpl',
      1 => 1423077326,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1835754be5b09811e20-23647140',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54be5b09890e93_83910820',
  'variables' => 
  array (
    'titulo' => 0,
    'menu' => 0,
    'menus' => 0,
    'submenu' => 0,
    'navegacion' => 0,
    'entradas' => 0,
    'salidas' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54be5b09890e93_83910820')) {function content_54be5b09890e93_83910820($_smarty_tpl) {?><html>
    <head>
        <meta http-equiv = "Content-Type" content = "text/html; charset=utf-8"/>
        <link type = "text/css" rel = "stylesheet" href = "estilos.css"/>
        <link type="text/javascript" href="../../scripts.js" />
        <title><?php echo $_smarty_tpl->tpl_vars['titulo']->value;?>
</title>
    </head>
    <body>
        <div id="cabecera"></div>
        <nav id="menu">
            <ul>
                <?php  $_smarty_tpl->tpl_vars['menus'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['menus']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['menu']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['menus']->key => $_smarty_tpl->tpl_vars['menus']->value) {
$_smarty_tpl->tpl_vars['menus']->_loop = true;
?>
                    <li>
                        <a><?php echo $_smarty_tpl->tpl_vars['menus']->value['titulo'];?>
</a>
                        <ul>
                            <?php  $_smarty_tpl->tpl_vars['submenu'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['submenu']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['menus']->value['submenu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['submenu']->key => $_smarty_tpl->tpl_vars['submenu']->value) {
$_smarty_tpl->tpl_vars['submenu']->_loop = true;
?>
                                <li>
                                    <a href="index.php?nav=<?php echo $_smarty_tpl->tpl_vars['submenu']->value['navegacion'];?>
"><?php echo $_smarty_tpl->tpl_vars['submenu']->value['titulo'];?>
</a>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </nav>
        <div id="cuerpo">            
            <div id="lista">
                <?php if ($_smarty_tpl->tpl_vars['navegacion']->value=="1") {?>
                    <?php echo $_smarty_tpl->getSubTemplate ("addentrada.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
                    
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['navegacion']->value=="2") {?>
                    <?php if (empty($_smarty_tpl->tpl_vars['entradas']->value)===false) {?>
                        <?php echo $_smarty_tpl->getSubTemplate ("verentradas.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
                    
                    <?php }?>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['navegacion']->value=="3") {?>
                    <?php echo $_smarty_tpl->getSubTemplate ("addsalida.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
                    
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['navegacion']->value=="4") {?>
                    <?php if (empty($_smarty_tpl->tpl_vars['salidas']->value)===false) {?>
                        <?php echo $_smarty_tpl->getSubTemplate ("versalidas.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
                    
                    <?php }?>
                <?php }?>                
            </div>            
            <div id="detalle">                 
                <div id="visualizador">
                </div>
                <div id="pdfs">
                </div>
            </div>
        </div>
    </body>    
</html><?php }} ?>
