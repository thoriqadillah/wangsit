<?php

namespace App\Http\Controllers;

use App\Services\ExampleService;
use Illuminate\Http\Request;

class ExampleController extends Controller
{
    protected ExampleService $example;

    public function __construct(ExampleService $exampleService) {
        $this->example = $exampleService;
    }

    public function index() {
        return $this->example->hello("example");
    }

    public function debug() {
        return 'hello debug';
    }
}
