<div id="nuevo_registro">
    <form id="form" action="index.php" method="post" enctype="multipart/form-data" onsubmit="return validarEnvioRegistro();">
        <h3>Nuevo Registro de Salida</h3>
        <div>            
            Nº registro:&nbsp;<input type="text" id="nreg" name="nreg" readonly="1" value="{$nreg}"/>
            Remitente:&nbsp;
            <select id="remit" name="remit">
                {foreach from=$personas item=persona}
                    <option value="{$persona->getId_persona()}">{$persona->getNombre()} {$persona->getApellido1()} {$persona->getApellido2()}</option>
                {/foreach}
            </select>
            Destinatario:&nbsp;
            <select id="dest" name="dest">
                {foreach from=$personas item=persona}
                    <option value="{$persona->getId_persona()}">{$persona->getNombre()} {$persona->getApellido1()} {$persona->getApellido2()}</option>
                {/foreach}
            </select>
            
        </div>
        <div>
            Tipo Doc:&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="tipodoc" name="tipodoc" maxlength="15"/>                            
            Fecha:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="date" id="fecha" name="fecha" value="{$fechaahora}"/>              
        </div>
        <div>
            Escaneado: <input type="checkbox" id="esc" name="esc" onclick="mostrarOcultar(document.getElementById('esc').checked);" />&nbsp;&nbsp;
            <!-- Añadimos multiple="" y definimos el nombre con corchetes como un array al input tipo file para permitir la selección de multiples ficheros -->
            <input type="file" id="addfile" name="addfile[]" readonly="1" value="" multiple="" />
        </div>              
        <div>            
            <input type="submit" value="Insertar registro" title="Insertar registro" alt="Insertar registro">              
            <input type="hidden" value="3" name="nav" title="nav" />
        </div>
     </form>
  </div>
<!-- Ejecutamos la función para ocultar el botón de añadir fichero al cargar 
la plantilla -->
<script>mostrarOcultar(document.getElementById('esc').checked);</script>
