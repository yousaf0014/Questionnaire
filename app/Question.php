<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    //
    protected $fillable = [
        'statement','type','correct','questionnaire_id'
    ];

    public function questionnaire(){
    	return $this->belongsTo(Questionnaire::class);
    }

    public function questionAnswer(){
    	return $this->hasMany(QuestionAnswer::class);
    }
}
