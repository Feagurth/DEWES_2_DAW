<html>
    <head>
        <meta http-equiv = "Content-Type" content = "text/html; charset=utf-8"/>
        <link type = "text/css" rel = "stylesheet" href = "estilos.css"/>
        <link type="text/javascript" href="../../scripts.js" />
        <title>{$titulo}</title>
    </head>
    <body>
        <div id="cabecera"></div>
        <nav id="menu">
            <ul>
                {foreach from=$menu item=menus}
                    <li>
                        <a href="#">{$menus.titulo}</a>
                        <ul>
                            {foreach from=$menus.submenu item=submenu}
                                <li>
                                    <a onclick="">{$submenu.titulo}</a>
                                </li>
                            {/foreach}
                        </ul>
                    </li>
                {/foreach}
            </ul>
        </nav>
        <div id="cuerpo">
            <form id="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                <div id="lista">
                    {if empty($entradas) === false}
                        {include file="verentradas.tpl"}                    
                    {/if}
                </div>            
                <div id="detalle">                 
                    <div id="visualizador">
                    </div>
                    <div id="pdfs">
                    </div>
                </div>
            </form>
        </div>
    </body>    
</html>