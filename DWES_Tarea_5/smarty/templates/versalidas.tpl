<div class="listado">
    <h3>Registro de Salida</h3>
    <table>
        <thead>
            <tr>
                <td>Nº Registro</td>    
                <td>Tipo</td>    
                <td>Fecha Salida</td>    
                <td>Remitente</td>    
                <td>Destinatario</td>    
                <td>Escaneado</td>    
            </tr>        
        </thead>    
        <tbody>
            {foreach from=$salidas item=salida}
                {if $salida@iteration is div by 2}
                    <tr class="pijama1">
                {else}
                    <tr class="pijama2">
                {/if}
                    <td>{$salida->getNreg()}</td>
                    <td>{$salida->getTipodoc()}</td>
                    <td>{$salida->getFecha()}</td>
                    <td>{$salida->getRemitente()}</td>
                    <td>{$salida->getDestinatario()}</td>
                    <td>
                        {if $salida->getEscaneado() === "0"}
                            <img src='imagenes/no_file.png' alt='No hay fichero asociado al registro' title='No hay fichero asociado al registro'>
                        {else}
                            <img class="pointer"src='imagenes/view_file.png' alt='Hay ficheros asociados al registro' title='Hay ficheros asociados al registro' onclick="listarFichero(4, {$salida->getId()});">
                        {/if}
                    </td>                
                </tr>            
            {/foreach}
        </tbody>
    </table>
</div>