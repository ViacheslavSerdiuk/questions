<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;



class Question extends Model
{
    use VotableTrait;


    protected $fillable = ['title','body'];

    protected  $appends = ['created_date','is_favorited','favorites_count','body_html','data_url'];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;

        $this->attributes['slug'] = Str::slug($value);
    }

    public function getUrlAttribute()
    {
        return route('questions.show',$this->slug);
    }

    public function getDataUrlAttribute()
    {
        return route('questions.update',$this->id);
    }

    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute() {

        if($this->answers_count > 0){
            if($this->best_answer_id){
                return "answered-accepted";
            }

            return "answered";
        }
        return "unanswered";
    }

    public function getBodyHtmlAttribute()
    {
        return $this->bodyHtml();
    }

    public function answers()
    {
        return $this->hasMany(Answer::class)->orderBy('votes_count','DESC');
    }

    public function acceptBestAnswer(Answer $answer)
    {

        $this->best_answer_id = $answer->id;
        $this->save();
    }

    public function removeBestAnswer(Answer $answer)
    {

        $this->best_answer_id = null;
        $this->save();
    }

    public function favorites()
    {
       return $this->belongsToMany(User::class,'favorites')->withTimestamps();
    }

    public function isFavorited()
    {
        return $this->favorites()->where('user_id', auth()->id())->count() > 0;
    }

    public function getIsFavoritedAttribute()
    {
        return $this->isFavorited();
    }


    public function getFavoritesCountAttribute()
    {
        return $this->favorites->count();
    }



    private function bodyHtml()
    {
        return  \Parsedown::instance()->text($this->body);
    }

    //not use
    public function excerpt($length)
    {

        return Str::limit(strip_tags($this->bodyHtml()),$length);
    }

 /*   public function setBodyAttribute($value)
    {
        $this->attributes['body'] = clean($value);
    }*/

    public static function add($fields)
    {

        $question = new static;

        $question->fill($fields);

        $question->save();

        return $question;

    }

    public function setCategory($id)
    {
        if($id == null) {return;}

        $this->category_id =$id;

        $this->save();
    }
    public function getCategoryTitle()
    {
        if($this->category != null)
        {

            return $this->category->title;
        }

        return '---';
    }

    public function hasCategory()
    {
        return $this->category != null ? true : false;
    }

}
