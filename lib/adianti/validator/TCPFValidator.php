<?php
namespace Adianti\Validator;

use Adianti\Validator\TFieldValidator;
use Adianti\Core\AdiantiCoreTranslator;
use Exception;

/**
 * CPF validation (Valid only in Brazil)
 *
 * @version    5.6
 * @package    validator
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    http://www.adianti.com.br/framework-license
 */
class TCPFValidator extends TFieldValidator
{
    /**
     * Validate a given value
     * @param $label Identifies the value to be validated in case of exception
     * @param $value Value to be validated
     * @param $parameters aditional parameters for validation
     */
    public function validate($label, $value, $parameters = NULL)
    {
        if (AdiantiCoreTranslator::getInstance()::getLanguage() == 'pt') {
          // cpfs inválidos
          $nulos = array("12345678909","11111111111","22222222222","33333333333",
                        "44444444444","55555555555","66666666666","77777777777",
                        "88888888888","99999999999","00000000000");
          // Retira todos os caracteres que nao sejam 0-9
          $cpf = preg_replace("/[^0-9]/", "", $value);
          
          if (strlen($cpf) <> 11)
          {
              throw new Exception(_t('The field ^1 has not a valid CPF', $label));
          }
          
          // Retorna falso se houver letras no cpf
          if (!(preg_match("/[0-9]/",$cpf)))
          {
              throw new Exception(_t('The field ^1 has not a valid CPF', $label));
          }

          // Retorna falso se o cpf for nulo
          if( in_array($cpf, $nulos) )
          {
              throw new Exception(_t('The field ^1 has not a valid CPF', $label));
          }

          // Calcula o penúltimo dígito verificador
          $acum=0;
          for($i=0; $i<9; $i++)
          {
            $acum+= $cpf[$i]*(10-$i);
          }

          $x=$acum % 11;
          $acum = ($x>1) ? (11 - $x) : 0;
          // Retorna falso se o digito calculado eh diferente do passado na string
          if ($acum != $cpf[9])
          {
            throw new Exception(_t('The field ^1 has not a valid CPF', $label));
          }
          // Calcula o último dígito verificador
          $acum=0;
          for ($i=0; $i<10; $i++)
          {
            $acum+= $cpf[$i]*(11-$i);
          }  

          $x=$acum % 11;
          $acum = ($x > 1) ? (11-$x) : 0;
          // Retorna falso se o digito calculado eh diferente do passado na string
          if ( $acum != $cpf[10])
          {
            throw new Exception(_t('The field ^1 has not a valid CPF', $label));
          }
        } else if (AdiantiCoreTranslator::getInstance()::getLanguage() == 'pt_pt') { // Valida o NIF de Portugal
          $nif = preg_replace("/[^0-9]/", "", $value);

          if (substr($nif,0,1) != '1' && // pessoa singular
              substr($nif,0,1) != '2' && // pessoa singular
              substr($nif,0,1) != '3' && // pessoa singular
              substr($nif,0,2) != '45' && // pessoa singular não residente
              substr($nif,0,1) != '5' && // pessoa colectiva
              substr($nif,0,1) != '6' && // administração pública
              substr($nif,0,2) != '70' && // herança indivisa
              substr($nif,0,2) != '71' && // pessoa colectiva não residente
              substr($nif,0,2) != '72' && // fundos de investimento
              substr($nif,0,2) != '77' && // atribuição oficiosa
              substr($nif,0,2) != '79' && // regime excepcional
              substr($nif,0,1) != '8' && // empresário em nome individual (extinto)
              substr($nif,0,2) != '90' && // condominios e sociedades irregulares
              substr($nif,0,2) != '91' && // condominios e sociedades irregulares
              substr($nif,0,2) != '98' && // não residentes
              substr($nif,0,2) != '99' // sociedades civis 
          ) 
          {
            throw new Exception(_t('The field ^1 has not a valid CPF', $label));  
          }

          $check1 = substr($nif,0,1)*9;
          $check2 = substr($nif,1,1)*8;
          $check3 = substr($nif,2,1)*7;
          $check4 = substr($nif,3,1)*6;
          $check5 = substr($nif,4,1)*5;
          $check6 = substr($nif,5,1)*4;
          $check7 = substr($nif,6,1)*3;
          $check8 = substr($nif,7,1)*2;

          $total = $check1 + $check2 + $check3 + $check4 + $check5 + $check6 + $check7 + $check8;
          $divisao = $total / 11;
          $modulo11 = $total - intval($divisao)*11;
          if ( $modulo11 == 1 || $modulo11 == 0) { 
            $comparador=0;
          } else { // excepção
            $comparador= 11 - $modulo11;
          }

          $ultimoDigito = substr($nif,8,1)*1;
          echo $ultimoDigito .'!='. $comparador;
          if ( $ultimoDigito != $comparador )
          { 
            throw new Exception(_t('The field ^1 has not a valid CPF', $label));  
          }
        }
    }
}
