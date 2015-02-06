<div id="nuevo_registro">
    <form id="form" action="index.php?nav=1" method="post" enctype="multipart/form-data">
        <h3>Nuevo Registro de Entrada</h3>
        <div>            
            Nº registro:&nbsp;<input type="text" id="nreg" name="nreg" readonly="1" value="{$nreg}"/>
            Remitente:&nbsp;<input type="text" id="remit" name="remit"/>
            Destinatario:&nbsp;<input type="text" id="dest" name="dest"/>
        </div>
        <div>
            Tipo Doc:&nbsp;&nbsp;&nbsp;<input type="text" id="tipodoc" name="tipodoc"/>                            
            Fecha:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="date" id="fentrada" name="fentrada" value="{$fechaahora}"/>              
        </div>
        <div>
            Escaneado: <input type="checkbox" id="esc" name="esc" onclick="mostrarOcultar(document.getElementById('esc').checked);" />&nbsp;&nbsp;
            <!-- Añadimos multiple="" y definimos el nombre con corchetes como un array al input tipo file para permitir la selección de multiples ficheros -->
            <input type="file" id="addfile" name="addfile[]" readonly="1" value="" multiple="" />
        </div>              
        <div>
            <input type="submit" value="Insertar registro" title="Insertar registro" alt="Insertar registro">              
        </div>
     </form>
  </div>
<!-- Ejecutamos la función para ocultar el botón de añadir fichero al cargar 
la plantilla -->
<script>mostrarOcultar(document.getElementById('esc').checked);</script>
