<?php

namespace Tests\Feature;

use Faker\Factory;
use Tests\TestCase;
use App\Http\Models\Schedule;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Http\Models\User;
use App\Http\Models\Status;
use App\Http\Models\Helper;


class ScheduleTest extends TestCase
{
    use DatabaseTransactions;

    private $user;
    private $status;
    private $faker;

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
        $data = [
            'title' => 'Title test',
            'description' => 'Description test',
            'start_date' => $this->faker->dateTimeBetween('+1 days', '+5 days')->format("d/m/Y"),
            'due_date' =>  $this->faker->dateTimeBetween('+5 days', '+20 days')->format("d/m/Y"),
            'status_id' => "1",
            'user_id' => "1"
        ];

        $response = $this->postJson('api/schedules', $data);

        $response->assertStatus(201)->assertJsonStructure([
            'title',
            'description',
            'start_date',
            'due_date',
            'status_id',
            'user_id',
            'id'
        ]);
    }
    /**
     * Testa a listagem das agendas registradas
     *
     * @return void
     */
    public function testCanListSchedules()
    {
        $schedules = factory(Schedule::class)->create();

        $response = $this->call('GET', 'api/schedules');
        $response->assertStatus(200)->assertJsonStructure([
            '*' => [
                'id',
                'start_date',
                'due_date',
                'due_date_complete',
                'title',
                'description',
                'status_id',
                'user_id'
            ]
        ]);
    }

    public function testCanUpdateSchedule()
    {
        
        $schedule = factory(Schedule::class)->create();

        $data = [
            'title' => $this->faker->sentence . " - Edited",
            'description' => $this->faker->paragraph . " - Edited",
            'start_date' => Helper::dateToPtBr($schedule->start_date),
            'due_date' => Helper::dateToPtBr($schedule->due_date),
            'status_id' => "1",
            'user_id' => "1"
        ];


        $response = $this->putJson('api/schedules/' . $schedule->id, $data);
        
        $response->assertStatus(200);

        print_r($response);
    }

    public function testCanDeleteSchedule()
    {
        $schedule = factory(Schedule::class)->create();

        $response = $this->call('DELETE', 'api/schedules/'.$schedule->id);
        
        $response->assertStatus(200);
    }

    public function testCanSearchSchedulesByStartDate()
    {
        $schedules = factory(Schedule::class, 3)->create();

        $params = "initialDate=".$this->faker->dateTimeBetween('+1 days', '+5 days')->format("d/m/Y");
       
        $params.= "&finalDate=".$this->faker->dateTimeBetween('+5 days', '+10 days')->format("d/m/Y");
        
        $response = $this->call('GET', 'api/schedules?'.$params);
        
        $response->assertStatus(200);
    }
}
