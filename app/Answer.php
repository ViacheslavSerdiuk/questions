<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Answer extends Model
{

    use VotableTrait;

    protected $fillable = ['body','user_id'];

    protected $appends = ['created_date','body_html','is_best'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function getBodyHtmlAttribute(){

      // return $this->body;
       return \Parsedown::instance()->text($this->body);

    }

    public static function boot()
    {
        parent::boot();

        static::created(function ($answer){
           $answer->question->increment('answers_count');
        });

        static::deleted(function ($answer){
            $question = $answer->question;
            $answer->question->decrement('answers_count');
            if($question->best_answer_id === $answer->id){
                $question->best_answer_id = null;
                $question->save();
            }
        });



    }
    public function getCreatedDateAttribute(){

        return $this->created_at->diffForHumans();

    }

    public function getStatusAttribute()
    {
        return $this->isBest() ? 'vote-accepted':'';
    }

    public function getIsBestAttribute()
    {
           return $this->isBest();
    }


    public function isBest()
    {
        return $this->id === $this->question->best_answer_id;
    }

    public function excerpt($length)
    {

        return Str::limit(strip_tags($this->bodyHtml()),$length);
    }

    private function bodyHtml()
    {
        return  \Parsedown::instance()->text($this->body);
    }

}
