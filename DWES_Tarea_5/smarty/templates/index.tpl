<html>
    <head>
        <meta http-equiv = "Content-Type" content = "text/html; charset=utf-8"/>
        <link type = "text/css" rel = "stylesheet" href = "estilos.css"/>
        <title>{$titulo}</title>
    </head>
    <body>
        <div id="cabecera"></div>
        <div id="menu">
            <ul>
                {foreach from=$menu item=menus}
                    <li><a href="{$menus.url}">{$menus.titulo}</a></li>
                {/foreach}
            </ul>
        </div>
        <div id="cuerpo">
            <div id="lista">
            </div>            
            <div id="detalle">                 
                <div id="visualizador">
                </div>
                <div id="pdfs">
                </div>
            </div>
        </div>
    </body>    
</html>