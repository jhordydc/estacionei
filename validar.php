<?php

    function valida_placa($placa){
        global $valido;
        $valido = true;
        $separado = str_split($placa);
    
        if (strlen($placa) == 7) {
            for ($i=0; $i < strlen($placa); $i++) {
                if ($i <= 2 and is_numeric($separado[$i])) {
                    $valido = false;
                    break;
                }
                elseif ($i == 3 and !is_numeric($separado[$i]) or $i >= 5 and !is_numeric($separado[$i])) {
                    $valido = false;
                    break;
                    // ABC 1414
                    // ADC 2V55
                }
            }
        }
        else {
            $valido = false;
        }
    
        if ($valido == true) {
            // session_start();
            $_SESSION['placa'] = $placa;
        }
    }
?>