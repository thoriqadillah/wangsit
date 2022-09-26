<?php

namespace Tests\Feature;

use App\Services\ScrapperService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ScraperTest extends TestCase
{
    public function test_successfuly_scrap_user()
    {
        $scraper = new ScrapperService('195150400111034', env('PASSWORD_SIAM'));
        $user = $scraper->scrapUser();
        
        $this->assertNotEquals([], $user);
    }

    public function test_failed_scrap_user()
    {
        $scraper = new ScrapperService('195150400111034', 'secret');
        $user = $scraper->scrapUser();
        
        $this->assertEquals([], $user);
    }

    public function test_not_sistem_information_student()
    {
        $scraper = new ScrapperService('195150410111034', env('PASSWORD_SIAM'));
        $user = $scraper->scrapUser();
        
        $this->assertEquals([], $user);
    }
}
