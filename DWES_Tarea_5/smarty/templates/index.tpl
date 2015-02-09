<html>
    <head>
        <meta http-equiv = "Content-Type" content = "text/html; charset=utf-8"/>
        <link type = "text/css" rel = "stylesheet" href = "estilos.css"/>        
        <title>{$titulo}</title>
    </head>
    <body>
        <div id="cabecera"></div>
        <nav id="menu">
            <ul>
                {foreach from=$menu item=menus}
                    <li>
                        <a>{$menus.titulo}</a>
                        <ul>
                            {foreach from=$menus.submenu item=submenu}
                                <li>
                                    <a href="#" onclick="navegar({$submenu.navegacion});">{$submenu.titulo}</a>
                                </li>
                            {/foreach}
                        </ul>
                    </li>
                {/foreach}
            </ul>
        </nav>
        <div id="cuerpo">            
            <div id="lista">
                {if $nav == "1"}
                    {include file="addentrada.tpl"}                    
                {/if}
                {if $nav == "2"}
                    {if empty($entradas) === false}
                        {include file="verentradas.tpl"}                    
                    {/if}
                {/if}
                {if $nav == "3"}
                    {include file="addsalida.tpl"}                    
                {/if}
                {if $nav == "4"}
                    {if empty($salidas) === false}
                        {include file="versalidas.tpl"}                    
                    {/if}
                {/if}                
                {if $nav == "5"}
                    {include file="addpersona.tpl"}                    
                {/if}                      
            </div>            
            <div id="detalle">                 
                <div id="visualizador">
                    {if empty($file) === false}
                        {include file="visor.tpl"}
                    {/if}
                </div>
                <div id="pdfs">
                    {if empty($docs) === false}
                        {include file="ficheros.tpl"}
                    {/if}
                </div>
            </div>
        </div>
    </body>    
</html>