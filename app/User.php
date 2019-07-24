<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'user_avatar','password'
    ];

    protected $appends = ['url','avatar','count_questions','count_answers'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function questions(){

        return $this->hasMany(Question::class);
    }

    public function getUrlAttribute(){

        return '/profile/'.$this->id;

    }
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }


    public function getAvatarAttribute()
    {

        return $this->getImage();
    }

    public function favorites()
    {
       return $this->belongsToMany(Question::class,'favorites')->withTimestamps();
    }

    public function voteQuestions()
    {
        return $this->morphedByMany(Question::class,'votable');
    }

    public function voteAnswers()
    {
        return $this->morphedByMany(Answer::class,'votable');

    }

    public function voteQuestion(Question $question,$vote)
    {
        $voteQuestions = $this->voteQuestions();

       return $this->_vote($voteQuestions,$question,$vote);

    }

    public function voteAnswer(Answer $answer,$vote)
    {
        $voteAnswers = $this->voteAnswers();

       return $this->_vote($voteAnswers,$answer,$vote);

    }

    private function _vote($relationship, $model, $vote)
    {
        if($relationship->where('votable_id',$model->id)->exists()){
            $relationship->updateExistingPivot($model,['vote'=>$vote]);
        }
        else {
            $relationship->attach($model,['vote'=>$vote]);
        }

        $model->load('votes');
        $downVotes = (int) $model->downVotes()->sum('vote');
        $upVotes = (int) $model->upVotes()->sum('vote');

        $model->votes_count = $upVotes + $downVotes;
        $model->save();

        return $model->votes_count;
    }

    public function getImage()
    {
        if($this->user_avatar == null)
        {
            return '/img/no-image.png';
        }
        return '/uploads/'.$this->user_avatar;
    }

    public function uploadAvatar($image){


        if($image == null) { return; }


        $this->removeAvatar();
        $filename = Str::random(10).'.'.$image->extension();
        $image->storeAs('uploads',$filename);
        $this->user_avatar =$filename;
        $this->save();

    }

    public function removeAvatar()
    {
        if($this->user_avatar != null)
        {
            Storage::delete('uploads/' . $this->user_avatar);
        }
    }

    public function edit($fields)
    {
        $this->fill($fields);

        $this->save();
    }

    public function generatePassword($password)
    {
        if($password != null)
        {
            $this->password = bcrypt($password);
            $this->save();
        }
    }

    public function getCountQuestionsAttribute()
    {
        return $this->questions()->count();
    }

    public function getCountAnswersAttribute()
    {
        return $this->answers()->count();
    }

    public static function add($fields)
    {
        $user = new static;
        $user->fill($fields);

        $user->save();

        return $user;
    }

    public function remove()
    {
        $this->removeAvatar();
        $this->delete();
    }


}
