<div class="listado">
    <table>
        <thead>
            <tr>
                <td>Nº Registro</td>    
                <td>Tipo de Documento</td>    
                <td>Fecha Entrada</td>    
                <td>Remitente</td>    
                <td>Destinatario</td>    
                <td>Escaneado</td>    
            </tr>        
        </thead>    
        <tbody>
            {foreach from=$entradas item=entrada}
                {if $entrada@iteration is div by 2}
                    <tr class="pijama1">
                {else}
                    <tr class="pijama2">
                {/if}
                    <td>{$entrada->getNreg()}</td>
                    <td>{$entrada->getTipodoc()}</td>
                    <td>{$entrada->getFecha()}</td>
                    <td>{$entrada->getRemitente()}</td>
                    <td>{$entrada->getDestinatario()}</td>
                    <td>
                        {if $entrada->getEscaneado() === "0"}
                            <img src='imagenes/no_file.png' alt='No hay fichero asociado al registro' title='No hay fichero asociado al registro'>
                        {else}
                            <img src='imagenes/view_file.png' alt='Hay ficheros asociados al registro' title='Hay ficheros asociados al registro' onclick="listarFichero(2, {$entrada->getId()});">
                        {/if}
                    </td>               
                </tr>            
            {/foreach}
        </tbody>
    </table>
</div>