<table>
    <thead>
        <tr>
            <td>Id</td>    
            <td>Nº Registro</td>    
            <td>Tipo de Documento</td>    
            <td>Fecha Salida</td>    
            <td>Remitente</td>    
            <td>Destinatario</td>    
            <td>Escaneado</td>    
        </tr>        
    </thead>    
    <tbody>
        {foreach from=$salidas item=salida}
            <tr>
                <td>{$salida.id}</td>
                <td>{$salida.nregistro}</td>
                <td>{$salida.tipodoc}</td>
                <td>{$salida.fentrada}</td>
                <td>{$salida.remitente}</td>
                <td>{$salida.destinatario}</td>
                <td>{$salida.escaneado}</td>                
            </tr>            
        {/foreach}
    </tbody>
</table>