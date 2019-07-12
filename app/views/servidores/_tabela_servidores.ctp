<table cellpadding="2" cellspacing="0" border="0" class="tbGrid sortable">
    <tr>
        <td class="tdTituloAcoesGrid nosort" style="width: 130px;">
            Ações
        </td>
        <td class="tdTituloGrid">
            Nome
        </td>
        <td class="tdTituloGrid">
            Setor
        </td>
        <td class="tdTituloGrid">
            Grupo de Usuário
        </td>
        <td class="tdTituloGrid">
            Cargo
        </td>
        <td class="tdTituloGrid">
            CPF
        </td>
        <td class="tdTituloGrid">
            Login
        </td>
        <td class="tdTituloGrid">
            Ativo
        </td>
    </tr>
    <?php foreach($servidores as $servidor) { ?>
        <tr class="trDisplay">
            <td class="tdAcoesGrid" style="width: 150px;">
                <?php echo $html->link($html->image('edit.png', array('alt'=>'Alterar Registro', 'title'=>'Alterar Registro',  'border' => 'none')),'/servidores/alterar/'.$servidor['Servidor']['id'],null,null,false)?>&nbsp;
                <?php echo $html->link($html->image('delete.jpg', array('alt'=>'Excluir Registro', 'title'=>'Excluir Registro', 'border' => 'none')),'/servidores/delete/'.$servidor['Servidor']['id'],null,"Você tem certeza de que deseja excluir o servidor de nome {$servidor['Servidor']['nome']}?",false)?>&nbsp;
                <?php echo $html->link($html->image('permissao.jpeg', array('alt'=>'Permissoes', 'title'=>'Permissões', 'border' => 'none')),'/servidores/exibir_permissoes/'.$servidor['Servidor']['id'],null,null,false)?>
                <?php echo $html->link($html->image('servidores.png', array('alt'=>'Setores', 'title'=>'Setores', 'border' => 'none')),'/servidores/exibir_setores/'.$servidor['Servidor']['id'],null,null,false)?>
                <?php echo $html->link($html->image('redefinir_senha.png', array('alt'=>'Redefinir Senha', 'title'=>'Redefinir Senha',  'border' => 'none', 'width' => '16px', 'height' => '16px')),'/servidores/redefinir_senha/'.$servidor['Servidor']['id'],null,null,false)?>&nbsp;
            </td>

            <td class="tdConteudoGrid">
                <?php echo $html->link($servidor['Servidor']['nome'], '/servidores/exibir/' . $servidor['Servidor']['id']); ?>
            </td>


            <td class="tdConteudoGrid" title="<?php echo $servidor['Setor']['descricao']?>">
                <?php
                //Exibe, caso exista, os Setores secundarios do servidor
                if(count($servidor['SetorServidor']) > 0) {
                    $arr_secundarios = array();
                    foreach($servidor['SetorServidor'] as $setores_secundarios ) {
                        $arr_secundarios[] = $setores_secundarios['Setor']['sigla'];
                    }
                     echo $servidor['Setor']['sigla']. ', '.  join(', ',$arr_secundarios);
                } else {
                     echo $servidor['Setor']['sigla'];
                }
                ?>

            </td>

            <td class="tdConteudoGrid">
                <?php echo $servidor['GrupoUsuario']['descricao'] ?>
            </td>

            <td class="tdConteudoGrid">
                <?php echo $servidor['Cargo']['descricao'] ?>
            </td>

            <td class="tdConteudoGrid">
                <?php echo $servidor['Servidor']['cpf'] ?>
            </td>

            <td class="tdConteudoGrid">
                <?php echo $servidor['Servidor']['login'] ?>
            </td>

            <td class="tdConteudoGrid">
                <?php echo $protocolo->showBooleanField($servidor['Servidor']['ativo']) ?>
            </td>

        </tr>
    <?php } ?>
</table>