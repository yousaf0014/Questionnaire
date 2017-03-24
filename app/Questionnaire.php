<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    
    protected $fillable = [
        'name','duration','duration_type','resume','user_id'
    ];

    public function question(){
    	return $this->hasMany(Question::class);
    }

    public function questionsCount()
	{
	  return $this->question()
	    ->selectRaw('questionnaire_id, count(*) as questions')
	    ->groupBy('questionnaire_id');
	}


}
