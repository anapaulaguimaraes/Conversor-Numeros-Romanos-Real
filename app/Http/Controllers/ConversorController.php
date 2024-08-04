<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConversorController extends Controller
{

    public const REAL_INPUT = 'real';
    public const ROMANO_INPUT = 'romano';

    /**
     * Converte um número real para um número romano.
     * 
     * @param Request $request Recebe um número real via requisição.
     * @return \Illuminate\View\View Retorna a visualização com o resultado da conversão para número romano.
     */
    public function converteRomano(Request $request)
    {
        $real = $request->input(self::REAL_INPUT);
        $resultado = $this->converteRealParaRomano($real);
        return view('conversor', ['resultado' => $resultado]);
    }

    /**
     * Converte um número romano para um número real.
     * 
     * @param Request $request Recebe um número romano via requisição. 
     * @return \Illuminate\View\View Retorna a visualização com o resultado da conversão para número real.
     */
    public function converteReal(Request $request)
    {
        $romano = $request->input(self::ROMANO_INPUT);
        $resultado = $this->converteRomanoParaReal($romano);
        return view('conversor', ['resultado' => $resultado]);
    }


    /**
     * Converte um número real para sua representação em número romano.
     * 
     * @param int $real Número real a ser convertido para o número romano.
     * @return string Representação em número romano do número real.
     */
    private function converteRealParaRomano($real)
    {

        if (!is_numeric($real) || $real <= 0 || $real > 3999) {
            return 'Insira um número inteiro positivo entre 1 e 3999.';
        }

        $reais = [
            1000 => 'M', 900 => 'CM', 500 => 'D', 400 => 'CD',
            100 => 'C', 90 => 'XC', 50 => 'L', 40 => 'XL',
            10 => 'X', 9 => 'IX', 5 => 'V', 4 => 'IV',
            1 => 'I'
        ];

        $resultado = '';

        foreach ($reais as $valor => $simbolo) {
            if ($real >= $valor) {
                $resultado .= str_repeat($simbolo, intdiv($real, $valor));
                $real %= $valor;
            }
        }
        return $resultado;
    }

    /**
     * Converte uma string de números romanos para um número real.
     * 
     * @param string $romano Número romano a ser convertido para o número real.
     * @return int|string Representação em número real do número romano ou uma mensagem de erro.
     */
    private function converteRomanoParaReal($romano)
    {
        $romano = strtoupper($romano);

        if (!preg_match('/^(M{0,3})(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})$/', $romano)) {
            return 'Insira um número romano válido (I, II, III, IV, V.)';
        }

        $romanos = [
            'M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400,
            'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40,
            'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4,
            'I' => 1
        ];

        $resultado = 0;
        $i = 0;

        while ($i < strlen($romano)) {
            if ($i + 1 < strlen($romano) && isset($romanos[substr($romano, $i, 2)])) {
                $resultado += $romanos[substr($romano, $i, 2)];
                $i += 2;
            } elseif (isset($romanos[$romano[$i]])) {
                $resultado += $romanos[$romano[$i]];
                $i += 1;
            } else {
                return 'Número romano inválido.';
            }
        }

        return $resultado;
    }
}