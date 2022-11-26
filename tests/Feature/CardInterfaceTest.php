<?php

namespace Tests\Feature;

use App\Services\GameService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class CardInterfaceTest extends TestCase
{

    /**
     * A basic feature test example.
     *
     * @return void
     */


    public function test_play_cards_not_working_with_zero(){
        $request = ['number_people' => 0];
        $value = $this->post(route('generate'), $request);
        $value->assertStatus(422);
        $value->assertSeeText('value is invalid');
    }


    public function test_play_cards_takes_only_numbers(){
        $request = ['number_people' => 'one'];
        $value = $this->post(route('generate'), $request);
        $value->assertStatus(422);
    }

    public function test_cards_are_served_with_one_ore_more_people(){
        $number = rand(1, 10000000000000);
        $value = $this->post(route('generate'), ['number_people' => $number]);
        $value->assertStatus(200);
        $this->assertGreaterThan(1, $number);
    }


}
