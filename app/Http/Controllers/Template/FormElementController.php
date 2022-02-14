<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormElementController extends Controller
{
    function formLayout(){
        return view('FormElements.form-elements');
    }
    function formValidation(){
        return view('FormElements.form-validation');
    }
    function formSwitch(){
        return view('FormElements.form-switch');
    }
    function formChechbox(){
        return view('FormElements.form-checkbox');
    }
    function formRadio(){
        return view('FormElements.form-radio');
    }

    public function  formWizard() {
        return view('FormWizards.form-wizard');
    }

    public function  formValidateWizard() {
        return view('FormWizards.validate-wizard');
    }

    public function  formVerticalWizard() {
        return view('FormWizards.vertical-wizard');
    }
}
