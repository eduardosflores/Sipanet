<form action="<?php echo $html->url('/servidores/cadastrar_permissoes/'.$servidor['Servidor']['id'])?>" method="post" name="addform">
        <fieldset class="fieldset">
            <legend>
                <b>| <label class="lbTituloLegend"><?php if (isset($fieldSetTitle)) {echo $fieldSetTitle;}?></label> |</b>
            </legend>
			
            <table cellpadding="2" cellspacing="0" border="0" class="tbFrm">
                <tr>
                    <td colspan="2" align="left">
                        <br /><label class="lbInfoPagFrm">Selecione o Módulo que o servidor terá acesso:</label>
						<br /><br />
						<label class="lbInfoPagFrm">Servidor: <?php echo $servidor['Servidor']['nome'] ?></label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="left">
                        &nbsp;
                    </td>
                </tr>
				<!-- Modulo -->
				<tr>
                    <td class="tbTituloFrm">
                        Módulos:
                    </td>
                   <td class="tbFieldFrm">
                       <?php 
					       foreach($modulos as $modulo) 
						  // array_has_key(key, array)
					       {
					
								echo '<input type="checkbox" name="data[PermissaoServidor][modulo_id][]" value="'.$modulo['Modulo']['id'].'" id="PermissaoServidorModuloId" '.
									(array_search($modulo['Modulo']['id'],$modulo_ids)===false ? '':'checked=checked')
									.' /> '.$modulo['Modulo']['descricao'].'<br />';
								
						   } 

				       ?>
					
                   </td>
                </tr>
				<tr>
                    <td  colspan="2" class="tbFieldFrm">
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td class="tbTituloFrm">
                        &nbsp;
                    </td>
                    <td class="tbFieldFrm">
                        <input type="submit" id="btnSalvar" name="btnSalvar" value="Salvar informações" />
                        <input type="button" id="btnCancelar" name="btnCancelar" onclick="javascript:window.location='<?php echo $this->webroot . 'servidores' ?>'" value="Cancelar" />
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
</div>
<br />