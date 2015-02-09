<div>    
    {foreach from=$docs item=doc}
        {if $doc['tipo']|substr:-3 === 'pdf'}
            <div><img src='imagenes/pdf.png' alt="{$doc['nombre']}" title="{$doc['nombre']}" onclick="mostrarFichero({$nav}, {$doc['id_registro']}, {$doc['id_documento']});"><p title="{$doc['nombre']}">{$doc['nombre']}</p></div>
        {/if}            
        {if $doc['tipo']|substr:-4 === 'jpeg' || $doc['tipo']|substr:-3 === 'png' || $doc['tipo']|substr:-3 === 'gif'}
            <div><img src='imagenes/pic.png' alt="{$doc['nombre']}" title="{$doc['nombre']}" onclick="mostrarFichero({$nav}, {$doc['id_registro']}, {$doc['id_documento']});"><p title="{$doc['nombre']}">{$doc['nombre']}</p></div>
        {/if}
        {if $doc['tipo']|substr:-12 === 'octet-stream'}
        <div><img src='imagenes/file.png' alt="{$doc['nombre']}" title="{$doc['nombre']}" onclick="descargarFichero({$doc['id_documento']});"><p title="{$doc['nombre']}">{$doc['nombre']}</p></div>
        {/if}                                    
    {/foreach}      
    
</div>
