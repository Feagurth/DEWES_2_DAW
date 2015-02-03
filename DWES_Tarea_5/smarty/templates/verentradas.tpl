<table>
    <thead>
        <tr>
            <td>Id</td>    
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
            <tr>
                <td>{$entrada.id}</td>
                <td>{$entrada.nregistro}</td>
                <td>{$entrada.tipodoc}</td>
                <td>{$entrada.fentrada}</td>
                <td>{$entrada.remitente}</td>
                <td>{$entrada.destinatario}</td>
                <td>{$entrada.escaneado}</td>                
            </tr>
            
        {/foreach}
    </tbody>
</table>