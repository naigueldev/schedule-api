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
    public static function dateToDb($date)
    {
        $date = ($date) ? implode("-",array_reverse(explode("/",$date))) : $date;
        
        return ($date) ? Carbon::parse($date)->format('Y-m-d') : $date;
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
    public static function formatColumns($request_all, $columns)
    {
        foreach($columns as $column){
            if($request_all[$column]){
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
}
