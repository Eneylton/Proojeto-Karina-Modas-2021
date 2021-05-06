<?php 

namespace App\Entidy;

use \App\Db\Database;

use \PDO;


class Compra{
    
    
    public $id;
    
    public $codigo;

    public $barra;

    public $nome;

    public $qtd;

    public $valor_compra;

    public $subtotal;

    public $produtos_id;

    public $usuarios_id;
    
    public $status;

    
    public function cadastar(){

        $this-> data = date('Y-m-d H:i:s');

        $obdataBase = new Database('compras');  
        
        $this->id = $obdataBase->insert([
          
            'codigo'          => $this->codigo, 
            'barra'           => $this->barra, 
            'nome'            => $this->nome, 
            'qtd'             => $this->qtd, 
            'valor_compra'    => $this->valor_compra, 
            'subtotal'        => $this->subtotal, 
            'produtos_id'     => $this->produtos_id, 
            'usuarios_id'     => $this->usuarios_id, 
            'status'          => $this->status

        ]);

        return true;

    }

    public function atualizar(){
        return (new Database ('compras'))->update('id = ' .$this-> id, [
    
                                                   
                                                'status'         => $this->status 
    
        ]);
      
    }

public static function getList($where = null, $order = null, $limit = null){

    return (new Database ('compras'))->select($where,$order,$limit)
                                   ->fetchAll(PDO::FETCH_CLASS, self::class);

}


public static function getReceber($where = null, $order = null, $limit = null){

    return (new Database ('compras'))->receber($where,$order,$limit)
                                   ->fetchAll(PDO::FETCH_CLASS, self::class);

}

public static function getUsuarios($where = null, $order = null, $limit = null){

    return (new Database ('usuarios'))->select($where,$order,$limit)
                                   ->fetchAll(PDO::FETCH_CLASS, self::class);

}

public static function getQtd($where = null){

    return (new Database ('compras'))->select($where,null,null,'COUNT(*) as qtd')
                                   ->fetchObject()
                                   ->qtd;

}


public static function getID($id){
    return (new Database ('compras'))->select('id = ' .$id)
                                   ->fetchObject(self::class);
 
}

public static function getITem($id){
    return (new Database ('compras'))->select('produtos_id = ' .$id)
                                   ->fetchObject(self::class);
 
}


public function excluir(){
    return (new Database ('compras'))->delete('id = ' .$this->id);
  
}




}