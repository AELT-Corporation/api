<?php
namespace App\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use App\Models\Entity\User;

/**
 * Controller v1 de Usuários
 */
class UserController {

    /**
     * Container Class
     * @var [object]
     */
    private $container;

    /**
     * Undocumented function
     * @param [object] $container
     */
    public function __construct($container) {
        $this->container = $container;
    }
    
    /**
     * Listagem de Usuáriosclea
     * @param [type] $request
     * @param [type] $response
     * @param [type] $args
     * @return Response
     */
    public function listUser($request, $response, $args) {
        $entityManager = $this->container->get('em');
        $UsersRepository = $entityManager->getRepository('App\Models\Entity\User');
        $Users = $UsersRepository->findAll();
        $return = $response->withJson($Users, 200)
            ->withHeader('Content-type', 'application/json');
        return $return;        
    }
    
    /**
     * Cria um usuário
     * @param [type] $request
     * @param [type] $response
     * @param [type] $args
     * @return Response
     */
    public function createUser($request, $response, $args) {
        $params = (object) $request->getParams();
        /**
         * Pega o Entity Manager do nosso Container
         */
        $entityManager = $this->container->get('em');
        /**
         * Instância da nossa Entidade preenchida com nossos parametros do post
         */
        $User = (new User())->setName($params->name)
            ->setPassword($params->password);
        
        /**
         * Registra a criação do usuário
         */
        $logger = $this->container->get('logger');
        $logger->info('User Created!', $User->getValues());

        /**
         * Persiste a entidade no banco de dados
         */
        $entityManager->persist($User);
        $entityManager->flush();
        $return = $response->withJson($User, 201)
            ->withHeader('Content-type', 'application/json');
        return $return;       
    }

    /**
     * Exibe as informações de um usuário 
     * @param [type] $request
     * @param [type] $response
     * @param [type] $args
     * @return Response
     */
    public function viewUser($request, $response, $args) {

        $id = (int) $args['id'];

        $entityManager = $this->container->get('em');
        $UsersRepository = $entityManager->getRepository('App\Models\Entity\User');
        $User = $UsersRepository->find($id); 

        /**
         * Verifica se existe um usuário com a ID informada
         */
        if (!$User) {
            $logger = $this->container->get('logger');
            $logger->warning("User {$id} Not Found");
            throw new \Exception("User not Found", 404);
        }    

        $return = $response->withJson($User, 200)
            ->withHeader('Content-type', 'application/json');
        return $return;   
    }

    /**
     * Atualiza um usuário
     * @param [type] $request
     * @param [type] $response
     * @param [type] $args
     * @return Response
     */
    public function updateUser($request, $response, $args) {

        $id = (int) $args['id'];

        /**
         * Encontra o usuário no Banco
         */ 
        $entityManager = $this->container->get('em');
        $UsersRepository = $entityManager->getRepository('App\Models\Entity\User');
        $User = $UsersRepository->find($id);   

        /**
         * Verifica se existe um usuário com a ID informada
         */
        if (!$User) {
            $logger = $this->container->get('logger');
            $logger->warning("User {$id} Not Found");
            throw new \Exception("User not Found", 404);
        }  

        /**
         * Atualiza e Persiste o usuário com os parâmetros recebidos no request
         */
        $User->setName($request->getParam('name'))
            ->setPassword($request->getParam('password'));

        /**
         * Persiste a entidade no banco de dados
         */
        $entityManager->persist($User);
        $entityManager->flush();        
        
        $return = $response->withJson($User, 200)
            ->withHeader('Content-type', 'application/json');
        return $return;       
    }

    /**
     * Deleta um usuário
     * @param [type] $request
     * @param [type] $response
     * @param [type] $args
     * @return Response
     */
    public function deleteUser($request, $response, $args) {

        $id = (int) $args['id'];

        /**
         * Encontra o usuário no Banco
         */ 
        $entityManager = $this->container->get('em');
        $UsersRepository = $entityManager->getRepository('App\Models\Entity\User');
        $User = $UsersRepository->find($id);   

        /**
         * Verifica se existe um usuário com a ID informada
         */
        if (!$User) {
            $logger = $this->container->get('logger');
            $logger->warning("User {$id} Not Found");
            throw new \Exception("User not Found", 404);
        }  

        /**
         * Remove a entidade
         */
        $entityManager->remove($User);
        $entityManager->flush(); 
        $return = $response->withJson(['msg' => "Deletando o usuário {$id}"], 204)
            ->withHeader('Content-type', 'application/json');
        return $return;    
    }
    
}