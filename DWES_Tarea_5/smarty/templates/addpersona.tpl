<div id="nueva_persona">
    <form id="form" name="personas" action="index.php" method="post" onsubmit="return validarEnvioPersona();">
        <h3>Registro de Personas</h3>
        <div>            
            Nombre:&nbsp;<input type="text" id="nombre" name="nombre"/>
            Primer Apellido:&nbsp;<input type="text" id="apellido1" name="apellido1"/>
            Segundo Apellido:&nbsp;<input type="text" id="apellido2" name="apellido2"/>
        </div>
        <div>            
            <input type="submit" value="Insertar Persona" title="Insertar Persona" alt="Insertar Persona">              
            <input type="hidden" value="5" name="nav" title="nav" />
        </div>
     </form>
</div>
<hr />
<div class="listado">
    <table>
        <thead>
            <tr>
                <td>Nombre</td>    
                <td>Primer Apellido</td>    
                <td>Segundo Apellido</td>    
                <td>&nbsp;</td>
            </tr>        
        </thead>    
        <tbody>
            {foreach from=$personas item=persona}
                {if $persona@iteration is div by 2}
                    <tr class="pijama1">
                {else}
                    <tr class="pijama2">
                {/if}
                    <td>{$persona->getNombre()}</td>
                    <td>{$persona->getApellido1()}</td>
                    <td>{$persona->getApellido2()}</td>
                    <td>
                        <img class="pointer"src='imagenes/user_delete.png' alt='Eliminar Persona' title='Eliminar Persona' onclick="eliminarPersona({$persona->getId_persona()});">
                    </td>                                    
                </tr>      
                
            {/foreach}
        </tbody>
    </table>    
</div>

