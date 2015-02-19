<div>
    {if $file['tipo']|substr:-3 === 'pdf'}
        {if $filename != ""}
            <object data="{$filename}" type="{$file['tipo']}" />
        {/if}
    {/if}
    {if $file['tipo']|substr:-4 === 'jpeg' || $file['tipo']|substr:-3 === 'png' || $file['tipo']|substr:-3 === 'gif' || $file['tipo']|substr:-3 === 'bmp'}
        <img src="data:{$file['tipo']};base64,{$file['documento']|base64_encode}" alt="{$file['nombre']}" />
    {/if}
    {if $file['tipo']|substr:-12 === 'octet-stream'}
        
    {/if}
  </object>
</div>