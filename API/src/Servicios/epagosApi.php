<?php

namespace App\Servicios\Epagos;

use Exception;

define('EPAGOS_ENTORNO_SANDBOX',    0);
define('EPAGOS_ENTORNO_PRODUCCION', 1);

class epagosApi
{
  const DEBUG_ACTIVADO   = false;

  private $_id_organismo = null;
  private $_id_usuario   = null;

  private $_entorno      = EPAGOS_ENTORNO_SANDBOX;
  private $_cliente      = null;
  private $_debug        = [];

  private $_token        = '';

  public function __construct($id_organismo, $id_usuario)
  {
    if ($id_organismo === '') {
      throw new Exception('Debe indicar el ID de organismo recibido para la implementación');
    }
    if (!$id_usuario) {
      throw new Exception('Debe indicar el ID de usuario recibido para la implementación');
    }
    $this->_id_organismo = $id_organismo;
    $this->_id_usuario   = $id_usuario;
  }
  public function set_entorno($entorno)
  {
    if (!in_array($entorno, [1, 0])) {
      throw new Exception('Indique un entorno válido');
    }
    $this->_entorno = $entorno;
  }
  public function obtener_token($password, $hash)
  {
    if (!$password) {
      throw new Exception('Debe indicar el password recibido para la implementación');
    }
    if (!$hash) {
      throw new Exception('Debe indicar el hash recibido para la implementación');
    }

    $credenciales = array(
      'id_usuario'   => $this->_id_usuario,
      'id_organismo' => $this->_id_organismo,
      'password'     => $password,
      'hash'         => $hash
    );

    $this->_cliente = new \SoapClient($this->get_url(), array(
      'soap_version'  => SOAP_1_1,
      'trace'         => true,
      'exceptions'    => false,
      'cache_wsdl'    => WSDL_CACHE_NONE
    ));

    if (is_soap_fault($this->_cliente)) {
      if (self::DEBUG_ACTIVADO) {
        $this->_debug[] = 'obtener_token :: ' . $this->_cliente->__getLastResponse();
      }
      throw new Exception($this->_cliente->faultcode . ' - ' . $this->_cliente->faultstring);
    }

    $resultado = $this->_cliente->obtener_token($this->get_version(), $credenciales);

    if (self::DEBUG_ACTIVADO) {
      $this->_debug[] = 'obtener_token :: ' . $this->_cliente->__getLastResponse();
    }

    if (is_soap_fault($resultado)) {
      throw new Exception($this->_cliente->faultcode . ' - ' . $this->_cliente->faultstring);
    }

    $this->_token = $resultado['token'];
    return $resultado;
  }

  public function obtener_token_post($password, $hash)
  {
    if (!$password) {
      throw new Exception('Debe indicar el password recibido para la implementación');
    }
    if (!$hash) {
      throw new Exception('Debe indicar el hash recibido para la implementación');
    }

    $fields = [
      'id_usuario'   => $this->_id_usuario,
      'id_organismo' => $this->_id_organismo,
      'password'     => $password,
      'hash'         => $hash
    ];
    $post_field_string = http_build_query($fields, '', '&');
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $this->get_url_token());
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_field_string);
    curl_setopt($ch, CURLOPT_POST, true);
    $response = curl_exec($ch);

    // control de error HTTP
    if ($response === FALSE) {
      throw new Exception(curl_error($ch));
    }

    curl_close($ch);
    $resultado = json_decode($response);
    if ($resultado->token)
      $this->_token = $resultado->token;

    return $resultado;
  }
  /**OBTENER PAGOS **/
  public function obtener_pagos($criterios = [], $password, $hash){
    if (empty($criterios)){
      throw new Exception('Debe indicar algún crtierio de búsqueda de los pagos');
    }
    $this->obtener_token($password, $hash);
    if (!$this->_cliente){
      throw new Exception('Debe invocar primero al obtener_token');
    }
    $credenciales = array(
      'id_organismo' => $this->_id_organismo,
      'token'        => $this->_token
    );

    $resultado = $this->_cliente->obtener_pagos($this->get_version(), $credenciales, $criterios);
    if (is_soap_fault($resultado)) {
      throw new Exception($this->_cliente->faultcode. ' - ' .$this->_cliente->faultstring);
    }

    return $resultado;
  }

  public function get_version()
  {
    return '1.0';
  }
  /* METODOS PRIVADOS */
  private function get_url_token()
  {
    if ($this->_entorno == EPAGOS_ENTORNO_PRODUCCION)
      return 'https://api.epagos.com.ar/post.php';
    else
      return 'https://sandbox.epagos.com.ar/post.php';
  }
  private function get_url()
  {
    if ($this->_entorno == EPAGOS_ENTORNO_PRODUCCION)
      return 'https://api.epagos.com.ar/wsdl/index.php?wsdl';
    else
      return 'https://sandbox.epagos.com.ar/wsdl/index.php?wsdl';
  }
}
