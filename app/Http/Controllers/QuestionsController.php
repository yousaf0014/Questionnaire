<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Questionnaire;
use App\Question;
use App\QuestionAnswer;
use Auth;
use DB;

class QuestionsController extends Controller
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
    public function index(Request $request,Questionnaire $questionnaire){    
        $questionObj = new Question;
        $questionObj = $questionObj->where('questionnaire_id',$questionnaire->id);
        if($request->get('keyword')){
            $keyword = $request->get('keyword');
            $questionObj = $questionObj->Where('statement', 'like', '%'.$keyword.'%');
        }
        $questions = $questionObj->paginate(10);
        return View('Questions.index',compact('questionnaire','questions','keyword'));
    }


    public function create(Questionnaire $questionnaire){
        return View('Questions.create',compact('questionnaire','refere'));
    }


    public function store(Request $request,$questionnaireID){
        $data = $request->all();
        foreach($data['data'] as $questionAnswer){
            $questionObj = new Question;
            $questionObj->questionnaire_id = $questionnaireID;
            $questionObj->statement = $questionAnswer['statement'];
            $questionObj->type = $questionAnswer['type'];
            $questionObj->save();
            $id = $questionObj->id;
            foreach($questionAnswer['answer'] as $answer){
                $answer['question_id'] = $id;
                $questionObj->questionAnswer()->insert($answer);
            }
        }
        flash('Successfully Saved.','success');
        return redirect('/Questionnaire');
        
    }

    public function show(Questionnaire $questionnaire,$id){
        $questionObj = new Question;
        $questionObj = $questionObj->with(array('questionAnswer'));
        $question = $questionObj->find($id);
        return View('Questions.show',compact('questionnaire','question'));   
    }

    public function edit($id){ 
        $questionObj = new Question;
        $questionObj = $questionObj->with(array('questionAnswer'));
        $question = $questionObj->find($id);
        return View('Questions.edit',compact('question'));      
    }

    public function update(Request $request,$questionID){
        $data = $request->all();
        $questionObj =  new question;
        $questionObj = $questionObj->find($questionID);
        $questionAnswerObj = new questionAnswer;
        foreach($data['data'] as $questionAnswer){
            $questionObj->statement = $questionAnswer['statement'];
            $questionObj->type = $questionAnswer['type'];
            $questionObj->update();
            $questionAnswerObj->where('question_id',$questionID)->delete();
            foreach($questionAnswer['answer'] as $answer){
                $answer['question_id'] = $questionID;
                $questionObj->questionAnswer()->insert($answer);
            }
        }
        flash('Successfully Saved.','success');
        return redirect('/Questions/'.$questionObj->questionnaire_id);
    }

    public function delete(Question $question){
        if(!empty($question->id)){
            $question->delete();
            flash('Question Successfully deleted!','success');
        }else{
            flash('Error in deleting. Please try again later','error');
        }
        flash('Successfully deleted the Question!','success');
        return back();    
    }    
}