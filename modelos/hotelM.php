<?php
/*** CLASE HOTEL****/

class hotelM{

	public $id;
	public $nombre;
	public $descripcion;
	public $cantidadEstrellas;
	public $ciudad;
	public $direccion;
	public $telefono;
	public $email;
	public $ubicacionFotografia;
	private static $tabla = 'hoteles';

	public function __construct(){
		$this->id='';
		$this->nombre='';
		$this->descripcion='';
		$this->cantidadEstrellas='';
		$this->ciudad='';
		$this->direccion='';
		$this->telefono='';
		$this->email='';
		$this->ubicacionFotografia='';

	}

	public function save(){ //--esta funcion puede hacer el update tambien
		$bd=baseDatos::getInstance();
		$bd=new baseDatos(BD_USUARIO, BD_CONTRASENA, BD_NOMBRE_BD, BD_SERVIDOR);
		$bd->connect();
		if($this->id<>null){
		$columnas= array('IdH','nombre','descripcion','cantidadEstrellas','ciudad','direccion','telefono','email','ubicacionFotografia');
		$valores = array($this->id,$this->nombre, $this->descripcion, $this->cantidadEstrellas, $this->ciudad, $this->direccion, $this->telefono, $this->email, $this->ubicacionFotografia);
		$filtros=array('IdH'=>$this->id!= null);
		if (is_numeric($this->id) && $this->id > 0) {
			$bd->update(self::$tabla, $columnas, $valores, $filtros);
		} else {
			$bd->insert(self::$tabla, $columnas, $valores);
		}
		}else{
			$columnas= array('nombre','descripcion','cantidadEstrellas','ciudad','direccion','telefono','email','ubicacionFotografia');
			$valores = array($this->nombre, $this->descripcion, $this->cantidadEstrellas, $this->ciudad, $this->direccion, $this->telefono, $this->email, $this->ubicacionFotografia);
			$filtros=array('IdH'=>$this->id!= null);
			if (is_numeric($this->id) && $this->id > 0) {
				$bd->update(self::$tabla, $columnas, $valores, $filtros);
			} else {
				$bd->insert(self::$tabla, $columnas, $valores);
			}
		}$bd->disconnect();

	}


	public function delete() {
		$bd = BaseDatos::getInstance();
		$bd->delete(self::$tabla, array('IdH' => $this->id));
	}

	public static function find($id) {
		$bd = BaseDatos::getInstance();
		$bd->connect();
		$campos= array('IdH','nombre','descripcion','cantidadEstrellas','ciudad','direccion','telefono','email','ubicacionFotografia');
		$filtros = array('IdH' => $id);
		//$datos = $bd->select(self::$tabla, $columnas, $filtros,TRUE); OJO EL ERROR SUYO
		$datos=$bd->select($tabla, $filtros, $campos, true);
		$hotel = new hotelM();
		foreach ($datos as $item) {
			$hotel->id = $item['IdH'];
			$hotel->nombre = $item['nombre'];
			$hotel->descripcion = $item['descripcion'];
			$hotel->cantidadEstrellas = $item['cantidadEstrellas'];
			$hotel->ciudad=$item['ciudad'];
			$hotel->direccion = $item['direccion'];
			$hotel->telefono = $item['telefono'];
			$hotel->email = $item['email'];
			$hotel->ubicacionFotografia = $item['ubicacionFotografia'];
			break;
		}
		$bd->disconnect();
		return $hotel;
	}

	public static function findAll() {
		$bd = BaseDatos::getInstance();
		$bd->connect();
		$columnas= array('IdH','nombre','descripcion','cantidadEstrellas','ciudad','direccion','telefono','email','ubicacionFotografia');
		$datos = $bd->select(self::$tabla, $columnas,' ',false);
		$hoteles= array();
		foreach ($datos as $item) {
			$hotel = new hotelM();
			$hotel->id = $item['IdH'];
			$hotel->nombre = $item['nombre'];
			$hotel->descripcion = $item['descripcion'];
			$hotel->cantidadEstrellas = $item['cantidadEstrellas'];
			$hotel->ciudad=$item['ciudad'];
			$hotel->direccion = $item['direccion'];
			$hotel->telefono = $item['telefono'];
			$hotel->email = $item['email'];
			$hotel->ubicacionFotografia = $item['ubicacionFotografia'];
			array_push($hoteles, $hotel);
		}
		$bd->disconnect();
		return $hoteles;
	}



}