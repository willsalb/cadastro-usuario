<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController
{
  // public function index(Request $request) : Response
  // {
  //   // return new Response("Hello Wordl", 200);

  //   $response = new Response();
  //   $response->setContent(json_encode(
  //     [
  //       //Recebe o parametro e retorna ele no response. Recebendo os parametros por queryString
  //       "recebido" => $request->get('nome'),
  //       //Também pode pegar outros tipos de informações 
  //       "ip" => $request->getClientIp()
  //     ]
  //   ));
  //   $response->setStatusCode(200);

  //   return $response;
  // }
}