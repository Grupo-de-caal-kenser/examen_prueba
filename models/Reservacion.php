<?php
namespace Model;

class  Reservacion extends ActiveRecord{
    protected static $tabla = 'reservas';
    protected static $columnasDB = ['reserva_cliente_id','reserva_habitacion_id','reserva_fecha_inicio','reserva_fecha_fin','reserva_estado','reserva_situacion'];
    protected static $idTabla = 'reserva_id';


    public $reserva_id;
    public $reserva_cliente_id;
    public $reserva_habitacion_id;
    public $reserva_fecha_inicio;
    public $reserva_fecha_fin;
    public $reserva_estado;
    public $reserva_situacion;
    
    public function __construct($args =[])
    {
        $this->reserva_id = $args['reserva_id'] ?? null;
        $this->reserva_cliente_id = $args['reserva_cliente_id'] ?? '';
        $this->reserva_habitacion_id = $args['reserva_habitacion_id'] ?? '';
        $this->reserva_fecha_inicio = $args['reserva_fecha_inicio'] ?? '';
        $this->reserva_fecha_fin = $args['reserva_fecha_fin'] ?? '';
        $this->reserva_estado = $args['reserva_estado'] ?? '1';
        $this->reserva_situacion = $args['reserva_situacion'] ?? '1';
        
    }
}

?>