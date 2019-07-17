<?php

/**
 *  SipaNet 2.0 - Sistema de Informação Processual e Arquivo
  Copyright (C) 2008 Universidade Estadual de Ciências da Saúde de Alagoas - UNCISAL <http://www.uncisal.edu.br>

  This program is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program.  If not, see <http://www.gnu.org/licenses/>.

 */
class ProtocoloHelper extends Helper {

    public $helpers = array('Form');

    /**
     * Escreve valores $values passados para um campo booleano (padrão PostgreSQL (t|f)). $value[0] será escrito se $field = t, e $value[1] será escrito se $field = f
     * Caso $values não seja passado, vai padronizar como 'Sim' e 'Não'
     * @param string $field
     * @param array $values
     * @return string
     * */
    function showBooleanField($field, $values = null) {
        $values = ($values) ? $values : array('Sim', 'Não');
        return ($field == 't') ? $values[0] : $values[1];
    }

    /**
     * Escreve tags <options> para cada um dos itens do array $list
     * @param array $list
     * @param boolean $blankField - Se um primeiro option vazio deverá ser exibido
     * @param integer $selected - Índice do array que retornará como selected
     * @return string
     * */
    function optionsTag($list, $blankField=true, $selected=null) {
        $returnValue = "";

        if ($blankField) {
            $returnValue .= "<option value=\"\">Selecione</option>";
        }

        if (is_array($list))
            foreach ($list as $key => $item) {
                $is_selected = (($selected != null) && ($selected == $key)) ? 'selected="selected"' : '';
                $returnValue .= '<option value="' . $key . '" ' . $is_selected . '>' . $item . '</option>';
            }

        return $this->output($returnValue);
    }

    /**
     * Exibe uma data passada no formato dd/mm/yyyy
     * @param string $date - Data no formato yyyy-mm-dd
     * @return string
     * */
    function showDateBr($date, $showHour = false) {
        if ($showHour) {
            $hour = substr($date, 11, 5);
        }
        $date = substr($date, 0, 10);
        $new_date = explode('-', $date);
        if (count($new_date) == 3) {
            $output = $new_date[2] . '/' . $new_date[1] . '/' . $new_date[0];
            if ($showHour) {
                $output = $output . ' ' . $hour;
            }
            return $this->output($output);
        } else {
            return '';
        }
    }

    function dateInput($name, $userOptions = null) {
        $options = array(
            'type' => 'text',
            'label' => false,
            'class' => 'textArea textFieldWidth120 format-d-m-y divider-slash split-date',
            'maxlength' => '10',
            'readonly' => 'true',
            'onfocus' => "$('fd-but-{$this->domId($name)}').onclick('onclick')"
        );

        if (!is_null($userOptions)) {
            $options = array_merge($options, $userOptions);
        }

        return $this->Form->input($name, $options);
    }

    //CALCULANDO DIAS NORMAIS
    /* Abaixo vamos calcular a diferença entre duas datas. Fazemos uma reversão da maior sobre a menor
      para não termos um resultado negativo. */
    function CalculaDias($xDataInicial, $xDataFinal) {
        $time1 = $this->dataToTimestamp($xDataInicial);
        $time2 = $this->dataToTimestamp($xDataFinal);

        $tMaior = $time1 > $time2 ? $time1 : $time2;
        $tMenor = $time1 < $time2 ? $time1 : $time2;

        $diff = $tMaior - $tMenor;
        $numDias = $diff / 86400; //86400 é o número de segundos que 1 dia possui
        return $numDias;
    }

//LISTA DE FERIADOS NO ANO
    /* Abaixo criamos um array para registrar todos os feriados existentes durante o ano. */
    function Feriados($ano, $posicao) {
        $dia = 86400;
        $datas = array();
        $datas['pascoa'] = easter_date($ano);
        $datas['sexta_santa'] = $datas['pascoa'] - (2 * $dia);
        $datas['carnaval'] = $datas['pascoa'] - (47 * $dia);
        $datas['corpus_cristi'] = $datas['pascoa'] + (60 * $dia);
        $feriados = array(
            '01/01',
            date('d/m', $datas['carnaval']),
            date('d/m', $datas['sexta_santa']),
            date('d/m', $datas['pascoa']),
            '21/04',
            '01/05',
            date('d/m', $datas['corpus_cristi']),
            '12/10',
            '02/11',
            '15/11',
            '25/12',
        );

        return $feriados[$posicao] . "/" . $ano;
    }

//FORMATA COMO TIMESTAMP
    /* Esta função é bem simples, e foi criada somente para nos ajudar a formatar a data já em formato  TimeStamp facilitando nossa soma de dias para uma data qualquer. */
    function dataToTimestamp($data) {
        $ano = substr($data, 6, 4);
        $mes = substr($data, 3, 2);
        $dia = substr($data, 0, 2);
        return mktime(0, 0, 0, $mes, $dia, $ano);
    }

//SOMA 01 DIA
    function Soma1dia($data) {
        $ano = substr($data, 6, 4);
        $mes = substr($data, 3, 2);
        $dia = substr($data, 0, 2);
        return date("d/m/Y", mktime(0, 0, 0, $mes, $dia + 1, $ano));
    }

//CALCULA DIAS UTEIS
    /* É nesta função que faremos o calculo. Abaixo podemos ver que faremos o cálculo normal de dias ($calculoDias), após este cálculo, faremos a comparação de dia a dia, verificando se este dia é um sábado, domingo ou feriado e em qualquer destas condições iremos incrementar 1 */

    function DiasUteis($yDataInicial, $yDataFinal) {

        $diaFDS = 0; //dias não úteis(Sábado=6 Domingo=0)
        $calculoDias = $this->CalculaDias($yDataInicial, $yDataFinal); //número de dias entre a data inicial e a final
        $diasUteis = 0;

        while ($yDataInicial != $yDataFinal) {
            $diaSemana = date("w", $this->dataToTimestamp($yDataInicial));
            if ($diaSemana == 0 || $diaSemana == 6) {
                //se SABADO OU DOMINGO, SOMA 01
                $diaFDS++;
            } else {
                //senão vemos se este dia é FERIADO
                for ($i = 0; $i <= 12; $i++) {
                    if ($yDataInicial == $this->Feriados(date("Y"), $i)) {
                        $diaFDS++;
                    }
                }
            }
            $yDataInicial = $this->Soma1dia($yDataInicial); //dia + 1
        }
        return $calculoDias - $diaFDS;
    }

}
