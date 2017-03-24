<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Questionnaire;
use App\Question;
use Auth;
use DB;

class QuestionnaireController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {    
        $questionnaireObj = new Questionnaire;
        $questionnaireObj = $questionnaireObj->Where('user_id',Auth::user()->id);
        if(isset($request->keyword)){
            $keyword = $request->keyword;
            $questionnaireObj = $questionnaireObj->Where('name', 'like', '%'.$keyword.'%');
        }

        $questionnaireObj = $questionnaireObj->with(array('questionsCount'));
        $questionnaires = $questionnaireObj->paginate(10);
        return view('Questionnaires.index',compact('questionnaires','keyword'));
    }


    public function create(){
        return View('Questionnaires.create');
    }


    public function store(Request $request){
        $rules = array(
            'name'       => 'required',
            'resume'      => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('/Questionnaire/create')
                ->withErrors($validator)->withInput();
        } else {
            $questionnaireObj = new Questionnaire;
            $data = $request->all();
            $data['user_id'] = Auth::user()->id;
            $questionnaireObj->create($data);
            flash('Successfully Saved.','success');
            return redirect('/Questionnaire');
        }
    }

    public function show(Questionnaire $questionnaire){
        $questionObj = new Question;
        $questionObj = $questionObj->with(array('questionAnswer'));
        $questions = $questionObj->where('questionnaire_id',$questionnaire->id)->get(); 
        
        return View('Questionnaires.show',compact('questionnaire','questions'));   
    }

    public function edit(Questionnaire $questionnaire){ 
        return View('Questionnaires.edit',compact('questionnaire'));
    }

    public function update(Request $request,Questionnaire $questionnaire){
    // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'name'       => 'required',
            'resume'      => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('/Questionnaire/'.$content->id.'/edit')
                ->withErrors($validator)->withInput();
        } 
        
        //$questionnaireObj = new Questionnaire;
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        unset($data['_method']);unset($data['_token']); 
        $questionnaire->update($data);

        flash('Successfully updated Questionnaire!','success');
        return redirect('/Questionnaire');
    
    }

    public function delete(Questionnaire $questionnaire){
        $questionnaire->delete();
        flash('Successfully deleted the Questionnaire!','success');
        return redirect('/Questionnaire');
    }

    
    public function active(Questionnaire $questionnaire , $action) {
        $questionnaire->published = $action;
        $questionnaire->save();
        return back();    
    }    
}
