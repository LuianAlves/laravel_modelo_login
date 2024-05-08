<?php

namespace App\Traits;

trait HttpResponse
{
    protected function trait($type, $data = null, $message = null)
    {
        switch ($type) {
            case 'get':
                return response()->json([
                    'status' => 'sucesso',
                    'message' => 'Requisição de dados efetuada com sucesso!',
                    'data' => $data
                ], 200);

                break;
            case 'store':
                return response()->json([
                    'status' => 'sucesso',
                    'message' => 'Inserção de dados efetuada com sucesso!',
                    'data' => $data
                ], 200);

                break;
            case 'update':
                return response()->json([
                    'status' => 'sucesso',
                    'message' => 'Atualização de dados efetuada com sucesso!',
                    'data' => $data
                ], 200);

                break;
            case 'delete':
                return response()->json([
                    'status' => 'sucesso',
                    'message' => 'Remoção de dados efetuada com sucesso!',
                    'data' => $data
                ], 200);

                break;
            case 'notify':
                return response()->json([
                    'status' => 'atencao',
                    'message' => $message
                ], 404);

                break;
            case 'error':
                return response()->json([
                    'status' => 'erro',
                    'message' => 'Erro! Requisição de dados não efetuada.'
                ], 404);

                break;
        }
    }
}
