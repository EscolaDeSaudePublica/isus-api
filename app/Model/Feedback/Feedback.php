<?php

namespace App\Model\Feedback;

use App\Model\EnviavelPorEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Feedback implements EnviavelPorEmail
{
    public $email = '';
    public $tipoDeFeedback = '';
    public $texto = '';
    public $versaoAplicativo = '';
    public $plataforma = '';

    public function __construct(Request $request)
    {
        $dados = $request->all();
        $this->email = $dados['email'];
        $this->tipoDeFeedback = $dados['tipoDeFeedback'];
        $this->texto = $dados['texto'];
        $this->versaoAplicativo = $dados['versaoAplicativo'];
        $this->plataforma = $dados['plataforma'];
    }

    public function valido()
    {
        return !$this->validar()->fails();
    }

    public function erros()
    {
        return $this->validar()->errors();
    }

    public function enviarEmail()
    {
        $feedback = (array) $this;
        \Mail::send('email.feedback', ['dados' => $feedback], function ($mensagem) use ($feedback) {
            $mensagem->from(env('MAIL_USERNAME'), $feedback['email'])
            ->to('feedback.isus@esp.ce.gov.br')
            ->subject('ISUS APP - FEEDBACK. ' . date('d/m/Y H:i:s'));
        });
    }

    protected function validar()
    {
        $feedback = (array) $this;

        return Validator::make($feedback, [
            'email' => 'required',
            'tipoDeFeedback' => 'required',
            'texto' => 'required',
            'versaoAplicativo' => 'required',
            'plataforma' => 'required',
        ]);
    }
}
