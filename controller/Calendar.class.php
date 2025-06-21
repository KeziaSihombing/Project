<?php

class Calendar extends Controller {
    function landingPage(){
        $this->loadView('LandingPage.php');
    }

    function calendar(){
        $model = $this->loadModel('CalendarModel');
        $data = $model->getAllDiaries();
        $this->loadView('calendar.php', ['diary'=>$data]);
    }

}