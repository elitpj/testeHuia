<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Cliente extends Model
{
    protected $table = "clientes";

    protected $fillable = [
        'id',
        'nome',
        'cpf',
        'data_nascimento'
    ];

    public function getCliente($id) {

    	$cliente = Cliente::where('id', $id)->first();

    	return $cliente;
    }

    public function getClientes() {

        $clientes = Cliente::orderBy('nome', 'ASC')->paginate(10);

        return $clientes;
    }

    public function storeCliente($nome, $cpf, $data_nascimento) {
        $cliente = new Cliente;
        $cliente->nome = $nome;
        $cliente->cpf = $cpf;
        $cliente->data_nascimento = $data_nascimento;
        if($cliente->save()) {
            return $cliente;
        } else {
            return null;
        }
    }

    public function deleteCliente($id) {
        $cliente = Cliente::where('id', $id)->first();
        if(isset($cliente)) {
            if($cliente->delete()) {
                return true;
            }
        }
        return false;
    }

    public function updateCliente($nome, $cpf, $data_nascimento, $cliente_id) {
        $cliente = Cliente::where('id', $cliente_id)->first();
        if(isset($cliente)) {
            $cliente->nome = $nome;
            $cliente->cpf = $cpf;
            $cliente->data_nascimento = $data_nascimento;

            if($cliente->save()) {
                return $cliente;
            }
        }
        return nulll;
    }

    public function checkCPF($new_cpf, $cliente_id) {
        $cliente = Cliente::where('id', $cliente_id)->first();
        if($new_cpf != $cliente->cpf) {
            $cliente_aux = Cliente::where('cpf', $new_cpf)->first();
            if(isset($cliente_aux)) {
                return false;
            }
        }
        return true;
    }
}
