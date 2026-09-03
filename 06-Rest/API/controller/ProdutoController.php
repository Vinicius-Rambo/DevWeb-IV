<?php 
class ProdutoController{
    private $service;
    public function __construct($service){
        $this->service = $service;
    }

    function respostaJSON($dados, $statusCode=200){
        http_response_code($statusCode);
        header('Content-Type: application/json');

        echo json_encode($dados);
        exit;    
    }

    public function criar($dados){
        try{
            $resultado = $this->service->salvar($dadosRequisicao);
            return $this->RespostaJSON([
                "sucesso"=>true,
                "dados"=>$resultado
            ],201);

       } catch(Exception $e){
            return $this->RespostaJSON([
                "sucesso"=>false,
                "Erro"=>$e->getMessage()
            ],400);
       }
    }
}