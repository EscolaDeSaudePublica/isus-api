<?php

namespace App\Domains\QualiQualiz\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Questao extends Model
{
    use SoftDeletes;

    protected $table = 'qquiz_questoes';
    protected $fillable = [
        'questao',
        'url_imagem',
    ];

    protected $cast = [
        'questao' => 'string',
        'url_imagem' => 'string',
    ];

    public function alternativasQuestao()
    {
        return $this->hasMany('App\Domains\QualiQualiz\Models\AlterrnativaQuestao');
    }

    public function respostas()
    {
        return $this->hasMany('App\Domains\QualiQualiz\Models\Resposta');
    }

    public function quizQuestoes()
    {
        return $this->belongsToMany('App\Domains\QualiQualiz\Models\QuizQuestao');
    }
}
