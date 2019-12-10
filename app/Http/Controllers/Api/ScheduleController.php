<?php

namespace App\Http\Controllers\Api;

use App\Repositories\Contracts\ScheduleRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Schedule;
use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Http\Models\Helper;

class ScheduleController extends Controller
{
    private $model;

    public function __construct(ScheduleRepositoryInterface $schedule)
    {
        $this->model = $schedule;    
    }
    /**
     * Mostra uma lista das atividades
     * @return json
     */
    public function index(Request $request)
    {
        return $this->model->getBetweenDate($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreScheduleRequest $request)
    {
        $request->validated();
        
        return $this->model->create($request->all());
    }

    /**
     * Mostra uma atividade
     *
     * @param  int  $id
     * @return json
     */
    public function show($id)
    {
        $res = $this->model->findById($id);
        
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
    public function update(UpdateScheduleRequest $request, $id)
    {
        $request->validated();

        $data = Helper::formatDateColumns($request->all(), $this->model->getColumnsToFormat());
        
        $schedule = $this->model->findById($id);
        
        $error_msg = Helper::responseMessage('Nenhuma agenda encontrada para atualizar');
        
        if(!$schedule)
            return response()->json($error_msg, 404);
        
        return $this->model->update($id, $data);
    }

    /**
     * Remove uma atividade da agenda
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = $this->model->delete($id);
        
        $suscess_msg = Helper::responseMessage('Deletado com sucesso');
        
        $error_msg = Helper::responseMessage('Falha ao deletar! Item não encontrado');
        
        return ($res) ? response()->json($suscess_msg, 200) : response()->json($error_msg, 409);
    }
}
