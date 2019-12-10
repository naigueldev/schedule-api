<?php

namespace Tests\Feature;

use Faker\Factory;
use Tests\TestCase;
use App\Http\Models\Schedule;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Http\Models\User;
use App\Http\Models\Status;
use DateTime;

class ScheduleTest extends TestCase
{
    use DatabaseTransactions;

    private $user;
    private $status;
    private $faker;
    private $date_format = 'd/m/Y H:i:s';

    private $default_structure = [
        'data' => [
            '0' => [
                'id_agenda',
                'data_prazo',
                'data_conclusao',
                'titulo',
                'descricao',
                'status' => [
                    'data' => [
                        'nome'
                    ]
                ],
                'user' => [
                    'data' => [
                        'nome'
                    ]
                ]
            ]
        ]
    ];

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();

        $this->status = factory(Status::class)->create();

        $this->faker = Factory::create();
    }

    /**
     * Testa a criação de uma agenda
     */
    public function testCanCreateSchedule()
    {
        $date = new DateTime();

        $data = [
            'title' => 'Title test',
            'description' => 'Description test',
            'start_date' => $date->modify('next monday')->format($this->date_format),
            'due_date' =>  $date->modify('next friday')->format($this->date_format),
            'status_id' => "1",
            'user_id' => "1"
        ];

        $response = $this->postJson('api/schedules', $data);

        $response->assertStatus(201);
    }

    /**
     * Testa a listagem das agendas registradas
     *
     * @return void
     */
    public function testCanListSchedules()
    {
        factory(Schedule::class)->create();

        $response = $this->call('GET', 'api/schedules');
        
        $response->assertStatus(200)
            ->assertJsonStructure($this->default_structure);
    }

    public function testCanUpdateSchedule()
    {
        $schedule = factory(Schedule::class)->create();

        $date = new DateTime();

        $data = [
            'title' => $this->faker->sentence . " - Edited",
            'description' => $this->faker->paragraph . " - Edited",
            'start_date' => $date->modify('next monday')->format($this->date_format),
            'due_date' =>  $date->modify('next friday')->format($this->date_format),
            'status_id' => "1",
            'user_id' => "1"
        ];

        $response = $this->putJson('api/schedules/' . $schedule->id, $data);

        $response->assertStatus(200)->assertJsonStructure($this->default_structure);
    }

    public function testCanDeleteSchedule()
    {
        $schedule = factory(Schedule::class)->create();

        $response = $this->call('DELETE', 'api/schedules/' . $schedule->id);

        $response
            ->assertStatus(200)
            ->assertExactJson([
                'data' => [
                    'message' => 'Deletado com sucesso'
                ]
            ]);
    }

    public function testCanNotDeleteNonexistentSchedule()
    {
        $schedule = factory(Schedule::class)->create();
       
        $new_id = intval($schedule->id) - 1;

        $response = $this->call('DELETE', 'api/schedules/'.$new_id);

        $response
            ->assertStatus(409)
            ->assertExactJson([
                'data' => [
                    'message' => 'Falha ao deletar! Item não encontrado'
                ]
            ]);
    }

    public function testCanSearchSchedulesByStartDate()
    {
        factory(Schedule::class, 3)->create();

        $params = "initialDate=" . $this->faker->dateTimeBetween('+1 days', '+5 days')->format($this->date_format);

        $params .= "&finalDate=" . $this->faker->dateTimeBetween('+5 days', '+10 days')->format($this->date_format);

        $response = $this->call('GET', 'api/schedules?' . $params);

        $response->assertStatus(200);
    }

    public function testCanNotStoreStartDateOnWeekend()
    {
        $date = new DateTime();

        $data = [
            'title' => 'Title test Weekend',
            'description' => 'Description test Weekend',
            'start_date' => $date->modify('next saturday')->format($this->date_format),
            'due_date' =>  $date->modify('next monday')->format($this->date_format),
            'status_id' => "1",
            'user_id' => "1"
        ];

        $response = $this->postJson('api/schedules', $data);

        $response
            ->assertStatus(422)
            ->assertExactJson([
                'errors' => [
                    'start_date' => ['Essa data não pode registrada no final de semana!']
                ]
            ]);
    }

    public function testCanNotStoreEndDateOnWeekend()
    {
        $date = new DateTime();

        $data = [
            'title' => 'Title test Weekend',
            'description' => 'Description test Weekend',
            'start_date' => $date->modify('next friday')->format($this->date_format),
            'due_date' =>  $date->modify('next sunday')->format($this->date_format),
            'status_id' => "1",
            'user_id' => "1"
        ];

        $response = $this->postJson('api/schedules', $data);

        $response
            ->assertStatus(422)
            ->assertExactJson([
                'errors' => [
                    'due_date' => ['Essa data não pode registrada no final de semana!']
                ]
            ]);
    }

    public function testCanNotStoreStartDateAndEndDateOnWeekend()
    {
        $date = new DateTime();

        $data = [
            'title' => 'Title test Weekend',
            'description' => 'Description test Weekend',
            'start_date' => $date->modify('next saturday')->format($this->date_format),
            'due_date' =>  $date->modify('next sunday')->format($this->date_format),
            'status_id' => "1",
            'user_id' => "1"
        ];

        $response = $this->postJson('api/schedules', $data);

        $response
            ->assertStatus(422)
            ->assertExactJson([
                'errors' => [
                    'start_date' => ['Essa data não pode registrada no final de semana!'],
                    'due_date' => ['Essa data não pode registrada no final de semana!']
                ]
            ]);
    }

    public function testCanNotStoreDuplicateDateByUser()
    {
        $date = new DateTime();

        $data = [
            'title' => 'Title test Weekend',
            'description' => 'Description test Weekend',
            'start_date' => $date->modify('next monday')->format($this->date_format),
            'due_date' =>  $date->modify('next friday')->format($this->date_format),
            'status_id' => "1",
            'user_id' => "1"
        ];

        $response = $this->postJson('api/schedules', $data);

        $date = new DateTime();

        $data = [
            'title' => 'Title test Weekend',
            'description' => 'Description test Weekend',
            'start_date' => $date->modify('next monday')->format($this->date_format),
            'due_date' =>  $date->modify('next friday')->format($this->date_format),
            'status_id' => "1",
            'user_id' => "1"
        ];

        $response = $this->postJson('api/schedules', $data);

        $response
            ->assertStatus(422)
            ->assertExactJson([
                'errors' => [
                    'user_id' => ['Não é permitido cadastros na mesma data e horário de outra atividade desse usuário!']
                ]
            ]);
    }
}
