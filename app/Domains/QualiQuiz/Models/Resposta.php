<?php

declare(strict_types=1);

namespace App\Domains\QualiQuiz\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Modelo para a tabela qquiz_resposta.
 *
 * @category QualiQuiz
 *
 * @author  Chicão Thiago <fthiagogv@gmail.com>
 * @license GPL3 http://www.gnu.org/licenses/gpl-3.0.en.html
 *
 * @link https://github.com/EscolaDeSaudePublica/isus-api
 */
class Resposta extends Model
{
    use SoftDeletes;

    public const DEFAULT_TYPE = 'email';

    protected $table = 'qquiz_respostas';
    protected $fillable = [
        'id',
        'quiz_id',
        'questao_id',
        'questao_alternativa_id',
        'identificacao',
        'tipo_identificacao',
        'tempo',
        'token',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $cast = [
        'tempo' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Relacionamento com o modelo Quiz.
     *
     * @return mix
     */
    public function quiz()
    {
        return $this->belongsTo(
            'App\Domains\QualiQuiz\Models\Quiz'
        );
    }

    /**
     * Relacionamento com o modelo Questao.
     *
     * @return mix
     */
    public function questao()
    {
        return $this->belongsTo(
            'App\Domains\QualiQuiz\Models\Questao'
        );
    }

    /**
     * Relacionamento com o modelo AlternativaQuestao.
     *
     * @return mix
     */
    public function alternativaQuestao()
    {
        return $this->belongsTo(
            'App\Domains\QualiQuiz\Models\AlternativaQuestao'
        );
    }
}
