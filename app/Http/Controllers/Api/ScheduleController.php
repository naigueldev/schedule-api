<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Schedule;
use App\Http\Requests\StoreScheduleRequest;
use App\Http\Models\Helper;
use Illuminate\Support\Facades\DB;


class ScheduleController extends Controller
{
    private $model;

    public function __construct(Schedule $schedule)
    {
        $this->model = $schedule;    
    }
    /**
     * Mostra uma lista das atividades
     * @return json
     */
    public function index(Request $request)
    {
        
        if ($request->has('initialDate') && $request->has('finalDate')) {
            $initialDate = Helper::dateToDb($request->initialDate);
            $finalDate = Helper::dateToDb($request->finalDate);
            $schedules = DB::table('schedules')->whereBetween('start_date', [$initialDate, $finalDate])->get();
            return $schedules;
        }

        return Schedule::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreScheduleRequest $request)
    {

        $request->validated();
        
        $data = Helper::formatColumns($request->all(), $this->model->formated_columns);

        return Schedule::create($data);
    }

    /**
     * Mostra uma atividade
     *
     * @param  int  $id
     * @return json
     */
    public function show($id)
    {
        $res = Schedule::find($id);
        
        $error_msg = Helper::responseMessage('Nenhum item encontrado');
        
        return ($res) ? response()->json($res, 200) : response()->json($error_msg, 404);
    }

    /**
     * Atualiza uma atividade da agenda
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return json
     */
    public function update(StoreScheduleRequest $request, $id)
    {
        $request->validated();

        $schedule = Schedule::find($id);
        
        $data = Helper::formatColumns($request->all(), $schedule->formated_columns);
        
        $schedule->update($data);

        return $schedule;
    }

    /**
     * Remove uma atividade da agenda
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $res = Schedule::destroy($id);
        
        $suscess_msg = Helper::responseMessage('Deletado com sucesso');
        
        $error_msg = Helper::responseMessage('Falha ao deletar');
        
        return ($res) ? response()->json($suscess_msg, 200) : response()->json($error_msg, 409);
        
    }
}
