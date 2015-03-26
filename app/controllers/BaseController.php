<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}
	
	protected static function jsonResponse( array $data = null ){
		$response = array( 'ok'=>1 );
		if( $data !== null ){
			$response['data'] = $data;
		}
		return Response::json( $response );
	}
	
	public static function jsonError( $error_message, $status_code=500, $data = null ){
		$error_data = array(
			'ok'=>0,
			'error_message'=>$error_message
		);
		if( !is_null($data) || count($data)>0 ){
			$error_data['data'] = $data;
		}
		return Response::json($error_data, $status_code);
	}

}
