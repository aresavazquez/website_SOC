<?php

class SimulatorController extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $this->View->render('simulator/index.html');
    }

    public function calculate(){
        $this->View->render('simulator/calculator.html');
    }
}
