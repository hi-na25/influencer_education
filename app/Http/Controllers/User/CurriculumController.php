<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class CurriculumController extends Controller
{
        public function showCurriculumList()
    {
        return view('user.curriculum_list'); 
    }
}
