<?php

class comentarioDTO{
public $id;

public $id_post;

public $usuario;

public $contenido;

public $fecha;

public function __construct($id, $id_post, $usuario, $contenido, $fecha){
$this->setComentario($id, $id_post, $usuario, $contenido, $fecha);
}

public function setComentario($id, $id_post, $usuario, $contenido, $fecha){
    $this->id=$id;
    $this->id_post= $id_post;
    $this->usuario= $usuario;
    $this->contenido= $contenido;
    $this->fecha= $fecha;
}

public function getID(){
    return $this->id;
}

public function getIdPost(){
    return $this->id_post;
}

public function getUsuario(){
    return $this->usuario;
}

public function getContenido(){
    return $this->contenido;
}

public function getFecha(){
    return $this->fecha;
}

public function getComentario(){
  
        $valores = array(
            'ID' => $this->id,
            'idPost' => $this->id_post,
            'usuario' => $this->usuario,
            'contenido' => $this->contenido,
            'fecha' => $this->fecha
            
        );
        return $valores;
}
}