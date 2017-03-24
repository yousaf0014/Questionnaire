<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionAnswer extends Model
{
    //
	protected $fillable = [
         'value'
    ];

    public function question(){
    	return $this->belongsTo(Question::class);
    }

}
