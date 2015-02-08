<div>
    {foreach from=$docs item=doc}
        {if $doc['tipo']|substr:-3 === 'pdf'}
            <p><img src='imagenes/pdf.png' >{$doc['nombre']}</p>
        {/if}            
        {if $doc['tipo']|substr:-4 === 'jpeg' || $doc['tipo']|substr:-3 === 'png'}            
            <p><img src='imagenes/pic.png' >{$doc['nombre']}</p>
        {/if}
        {if $doc['tipo']|substr:-12 === 'octet-stream'}
            <p><img src='imagenes/file.png' >{$doc['nombre']}</p>
        {/if}                                    
    {/foreach}      

</div>
