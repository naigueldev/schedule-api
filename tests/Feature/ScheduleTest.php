<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Models\Schedule;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Faker\Generator as Faker;


class ScheduleTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Testa a criação de uma agenda
     */
    public function testCanCreateSchedule()
    {   

        $data = [
            'title' => "Test title 001",
            'description' => "test description 002",
            'start_date' => "09/12/2019",
            'due_date' => "14/12/2019",
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
        
        $faker = factory(Schedule::class)->make();
        $schedule = factory(Schedule::class)->create();
        $data = [
            'title' => $faker->sentence." - Edited",
            'description' => $faker->paragraph." - Edited",
        ];

        $response = $this->putJson('api/schedules/'.$schedule->id, $data);

        $response->assertStatus(200)->assertJsonStructure($data);
    }
}
