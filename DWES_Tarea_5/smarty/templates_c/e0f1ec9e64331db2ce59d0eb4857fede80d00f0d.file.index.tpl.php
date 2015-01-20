<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-01-20 14:40:14
         compiled from "templates\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1919054be59d0656043-37556618%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e0f1ec9e64331db2ce59d0eb4857fede80d00f0d' => 
    array (
      0 => 'templates\\index.tpl',
      1 => 1421761213,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1919054be59d0656043-37556618',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54be59d06f26b4_25933055',
  'variables' => 
  array (
    'titulo' => 0,
    'categorias' => 0,
    'categoria' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54be59d06f26b4_25933055')) {function content_54be59d06f26b4_25933055($_smarty_tpl) {?><html>
    <head>
        <title><?php echo $_smarty_tpl->tpl_vars['titulo']->value;?>
</title>
        <link rel="stylesheet" type="text/css" href="#" />
    </head>
    <body>
        <h1><?php echo $_smarty_tpl->tpl_vars['titulo']->value;?>
</h1>
        <?php  $_smarty_tpl->tpl_vars['categoria'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['categoria']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['categorias']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['categoria']->key => $_smarty_tpl->tpl_vars['categoria']->value) {
$_smarty_tpl->tpl_vars['categoria']->_loop = true;
?>
            <a href="<?php echo $_smarty_tpl->tpl_vars['categoria']->value['url'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['categoria']->value['titulo'];?>
"><?php echo $_smarty_tpl->tpl_vars['categoria']->value['titulo'];?>
</a>
        <?php } ?>
    </body>
    
</html><?php }} ?>
