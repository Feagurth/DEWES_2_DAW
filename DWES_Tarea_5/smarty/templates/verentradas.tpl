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
                <td>{$entrada->getId()}</td>
                <td>{$entrada->getNreg()}</td>
                <td>{$entrada->getTipodoc()}</td>
                <td>{$entrada->getFecha()}</td>
                <td>{$entrada->getRemitente()}</td>
                <td>{$entrada->getDestinatario()}</td>
                <td>{$entrada->getEscaneado()}</td>                
            </tr>            
        {/foreach}
    </tbody>
</table>
