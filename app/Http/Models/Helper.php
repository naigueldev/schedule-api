<?php

namespace App\Http\Models;

use Carbon\Carbon;

class Helper
{   
    /**
     * Obtém a data formatada para o padrão do banco de dados
     * @param string $date
     * @return date
     */
    public static function dateToDb($date, $divider = '/')
    {
        $date = ($date) ? str_replace($divider, '-', $date) : $date;
        
        return ($date) ? Carbon::parse($date)->format('Y-m-d H:i:s') : $date;
    }

    /**
     * Obtém a data no formato pt_br
     * @param string $date
     * @return date
     */
    public static function dateToPtBr($date)
    {
        return ($date) ? Carbon::parse($date)->format('d/m/Y') : $date;
    }


    /**
     * Verifica se a data informada é fim de semana
     * @param date $date
     * @return boolean
     */
    public static function isWeekend($date)
    {
        $weekDay = date('w', strtotime($date));
        return ($weekDay == 0 || $weekDay == 6);
    }
    
    /**
     * Formata as colunas definidas no array columns
     * para o padrão do banco de dados Y-m-d
     * @param array $request_all
     * @param array $columns
     * @return array
     */
    public static function formatDateColumns($request_all, $columns)
    {
        foreach($columns as $column){
            if(isset($request_all[$column])){
                $request_all[$column] = Helper::dateToDb($request_all[$column]);
            }
        }
        return $request_all;
    }

    /**
     * Obtém o objeto padrão para mensagem das requisições
     * @param string $msg
     * @return array
     */
    public static function responseMessage($msg)
    {
        return [
            "data" => ['message' => $msg]
        ];
    }
    /**
     * Substitui a barra por traço no formato da data
     * 
     * @param string
     * @param string
     * @return string
     */
    public static function getDateToParse($date, $divider='/')
    {
        return ($date) ? str_replace($divider, '-', $date) : $date;
    }
}
