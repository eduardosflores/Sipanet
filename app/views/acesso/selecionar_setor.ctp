	<div class="div_principal">
        <fieldset class="fieldset">
            <legend>
                <b>| <label class="lbTituloLegend">
						<?php if (isset($fieldSetTitle))
						{
							echo $fieldSetTitle;
						}
						?>
					</label> |</b>
            </legend>
            <span style="text-align: left;">
                <h3>
                    Servidor: <?php echo $servidor['Servidor']['nome'] ?><br />
                    Órgão: <?php echo $session->read('Orgao.sigla') ?>
                </h3>
                
                <h4>Selecione o setor desejado:</h4>
                
                <ul style="font-size: 14px;">
                    <li><?php echo $html->link( $servidor['Setor']['descricao'], "/acesso/selecionar_setor/{$servidor['Setor']['id']}" ) ?></li>
                    
                    <?php foreach($setores_servidor as $setor) { ?>
                        <li>
                            <?php echo $html->link( $setor['Setor']['descricao'], "/acesso/selecionar_setor/{$setor['Setor']['id']}" ) ?>
                        </li>
                    <?php } ?>
                    
                </ul>
            </span>
        </fieldset>
        <br />
    </div>