<div id="nuevo_registro">
      <form id="form" action="index.php" method="post" enctype="multipart/form-data">
          <div>
              <h3>Nuevo Registro de Salida</h3>
              Nº registro: <input type="text" id="nreg" name="nreg" readonly="1" value=""/>
              Tipo Doc:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="tipodoc" name="tipodoc"/>
              Fecha:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="date" id="fsalida" name="fsalida" value="{$fechaahora}"/>
          </div>
          <div>
              Remitente:&nbsp;&nbsp;<input type="text" id="remit" name="remit"/>
              Destinatario: <input type="text" id="dest" name="dest"/>
              Escaneado: <input type="checkbox" id="esc" name="esc" onclick="mostrarOcultar(document.getElementById('esc').checked);" />&nbsp;&nbsp;
              <input type="file" id="addfile" name="addfile" readonly="1" value="" />
          </div>
          <div>
              <input type="submit" value="Insertar registro" title="Insertar registro" alt="Insertar registro">              
          </div>
     </form>
  </div>

<!-- Ejecutamos la función para ocultar el botón de añadir fichero al cargar 
la plantilla -->
<script>mostrarOcultar(document.getElementById('esc').checked);</script>
