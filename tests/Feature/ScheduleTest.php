<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Models\Schedule;
use Illuminate\Foundation\Testing\DatabaseTransactions;


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
        $schedules = factory(Schedule::class, 1)->create()->map(function ($schedule) {
            return $schedule->only([
                'id', 
                'start_date', 
                'due_date',
                'due_date_complete',
                'title',
                'description',
                'status_id',
                'user_id'
            ]);
        });
        
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

    // public function testCanUpdateSchedule()
    // {
    //     // $schedule = factory(Schedule::class)->create();
    //     // $data = [
    //     //     'title' => $this->faker->sentence,
    //     //     'description' => $this->faker->paragraph,
    //     //     'start_date' => 
    //     // ];
    //     // $this->put(route('posts.update', $post->id), $data)
    //     //     ->assertStatus(200)
    //     //     ->assertJson($data);
    // }
}
