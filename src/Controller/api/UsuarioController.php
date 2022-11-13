<?php

namespace App\Controller\api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Usuario;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

#[Route('/api/v1', name: 'api_usuario_')]
class UsuarioController extends AbstractController
{
  #[Route('/listar', methods: ['GET'], name: 'listar')]
  public function listar(ManagerRegistry $doctrine) : JsonResponse
  {
    //Retorna o repositorio da entidade.
    $ORM = $doctrine->getRepository(Usuario::class);

    return new JsonResponse(
      [
        $ORM->getall()
      ], 200
      );
  }

  #[Route('/cadastra', methods: ['POST'], name: 'cadastra')]
  public function cadastra(Request $request, ManagerRegistry $doctrine) : Response
  {
        // dump($request->request->all());

        $data = $request->request->all();

        $usuario = new Usuario;
    
        $usuario->setNome($data['nome']);
        $usuario->setEmail($data['email']);
    
        // dump($usuario);
    
        //Traz a instancia do ORM. Gerenciador de entidades.
        $ORM = $doctrine->getManager();
        
        //Persistindo a entidade e preparando todas as querys.
        $ORM->persist($usuario);
    
        //Informações sendo inseridas no db.
        $ORM->flush();
    
        // dump($usuario);
    
        //Validando se o usuario está ou não no DB.
        //$doctrine->contains($usuario)
        if($usuario->getId()) {
          return new Response("Ok", 200);
        } else {
          return new Response("Error", 404);
        }

    // return new JsonResponse(
    //   [
    //     "Cadastro em desenvolvimento"
    //   ], 404
    //   );
  }
}