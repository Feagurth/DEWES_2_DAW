<div id='mostrarerror'>
    <h3>No se ha podido realizar la petición solicitada</h3>
    <p>Código: {$error->getCode()}</p>
    <p>Informacion: {$error->getMessage()}</p>    
    <p>Pongase en contacto con el administrador en la siguiente dirección: {$emailadmin}</p>
    <p><a href="mailto:{$emailadmin}?subject=Error App Entradas-Salidas&body=%0A%0A%0A%0ACódigo de Error: {$error->getCode()}%0AMensaje de Error: {$error->getMessage()}">O pulse este enlace para enviar un mail con el error</a></p>
</div>