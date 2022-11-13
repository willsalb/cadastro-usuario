<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Usuario;

#[Route('/', name: 'usuario_web_')]
class UsuarioController extends AbstractController
{
  #[Route('/', methods: ['GET'], name: 'index')]
  public function index() : Response
  {
    return $this->render("views/form.html.twig");
  }

  #[Route('/salvar', methods: ['POST'], name: 'salvar')]
  public function salvar(Request $request, ManagerRegistry $doctrine) : Response
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
      return $this->render('views/sucess.html.twig', [
        "usuario" => $data['nome']
      ]);
    } else {
      return $this->render('views/error.html.twig', [
        "usuario" => $data['nome']
      ]);
    }
  }
}