<?php

namespace Tests\Feature;

use App\Jobs\HighJob;
use Illuminate\Support\Facades\Bus;
use Tests\TestCase;

class HighJobTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        Bus::fake();

        $this->post(route('faz alguma coisa'));
    }

    /** @test */
    public function it_()
    {
        HighJob::dispatchSync();
    }
}
