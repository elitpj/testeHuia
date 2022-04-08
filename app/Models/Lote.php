<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    protected $table = "lotes";

    protected $fillable = [
        'id',
        'data_fabricacao',
        'quantidade',
        'qualidade'
    ];

    public function getLote($lote_id) {

    	$lote = Lote::where('id', $lote_id)->first();

    	return $lote;
    }

    public function getLotes() {

        $lotes = Lote::orderBy('nome', 'ASC')->paginate(10);

        return $lotes;
    }

    public function storeLote($data_fabricacao, $quantidade, $qualidade) {
        $lote = new Lote;
        $lote->data_fabricacao = $data_fabricacao;
        $lote->quantidade = $quantidade;
        $lote->qualidade = $qualidade;
        if($lote->save()) {
            return $lote;
        } else {
            return null;
        }
    }

    public function deleteLote($lote_id) {
        $lote = Lote::where('id', $lote_id)->first();
        if(isset($lote)) {
            if($lote->delete()) {
                return true;
            }
        }
        return false;
    }

    public function updateLote($data_fabricacao, $quantidade, $qualidade, $lote_id) {
        $lote = Lote::where('id', $lote_id)->first();
        if(isset($lote)) {
            $lote->data_fabricacao = $data_fabricacao;
	        $lote->quantidade = $quantidade;
	        $lote->qualidade = $qualidade;

            if($lote->save()) {
                return $lote;
            }
        }
        return nulll;
    }
}
