<?php
namespace App\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use App\Models\Participation;

/**
 * Controller v1 de Usuários
 */
class ParticipationController {

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
    public function listParticipation($request, $response, $args) {
        $entityManager = $this->container->get('em');
        $ParticipationsRepository = $entityManager->getRepository('App\Models\Participation');
        $Participations = $ParticipationsRepository->findAll();
        $return = $response->withJson($Participations, 200)
            ->withHeader('Content-type', 'application/json');
        return $return;        
    }
    
    /**
     * Cria um participation
     * @param [type] $request
     * @param [type] $response
     * @param [type] $args
     * @return Response
     */
    public function createParticipation($request, $response, $args) {
        $params = (object) $request->getParams();
        /**
         * Pega o Entity Manager do nosso Container
         */
        $entityManager = $this->container->get('em');
        /**
         * Instância da nossa Entidade preenchida com nossos parametros do post
         */
        $Participation = (new Participation())->setIdUser($params->idUser)->setIdEvent($params->idEvent)
        ->setStatus($params->status);
        
        /**
         * Registra a criação do participation
         */
        $logger = $this->container->get('logger');
        $logger->info('Participation Created!', $Participation->getValues());

        /**
         * Persiste a entidade no banco de dados
         */
        $entityManager->persist($Participation);
        $entityManager->flush();
        $return = $response->withJson($Participation, 201)
            ->withHeader('Content-type', 'application/json');
        return $return;       
    }

    /**
     * Exibe as informações de um participation 
     * @param [type] $request
     * @param [type] $response
     * @param [type] $args
     * @return Response
     */
    public function viewParticipation($request, $response, $args) {

        $id = (int) $args['id'];

        $entityManager = $this->container->get('em');
        $ParticipationsRepository = $entityManager->getRepository('App\Models\Participation');
        $Participation = $ParticipationsRepository->find($id); 

        /**
         * Verifica se existe um participation com a ID informada
         */
        if (!$Participation) {
            $logger = $this->container->get('logger');
            $logger->warning("Participation {$id} Not Found");
            throw new \Exception("Participation not Found", 404);
        }
        
        /**
         * Registra a visualização do participation
         */
        $logger = $this->container->get('logger');
        $logger->info('Participation View!', $Participation->getValues());

        $return = $response->withJson($Participation, 200)
            ->withHeader('Content-type', 'application/json');
        return $return;   
    }

    /**
     * Atualiza um participation
     * @param [type] $request
     * @param [type] $response
     * @param [type] $args
     * @return Response
     */
    public function updateParticipation($request, $response, $args) {

        $id = (int) $args['id'];

        /**
         * Encontra o participation no Banco
         */ 
        $entityManager = $this->container->get('em');
        $ParticipationsRepository = $entityManager->getRepository('App\Models\Participation');
        $Participation = $ParticipationsRepository->find($id);   

        /**
         * Verifica se existe um participation com a ID informada
         */
        if (!$Participation) {
            $logger = $this->container->get('logger');
            $logger->warning("Participation {$id} Not Found");
            throw new \Exception("Participation not Found", 404);
        }  

        /**
         * Atualiza e Persiste o participation com os parâmetros recebidos no request
         */
        $Participation->setIdUser($request->getParam('idUser'))
            ->setIdEvent($request->getParam('idEvent'))
            ->setStatus($request->getParam('status'));

        /**
         * Persiste a entidade no banco de dados
         */
        $entityManager->persist($Participation);
        $entityManager->flush();      
        
        /**
         * Registra a criação do participation
         */
        $logger = $this->container->get('logger');
        $logger->info('Participation Update!', $Participation->getValues());
        
        $return = $response->withJson($Participation, 200)
            ->withHeader('Content-type', 'application/json');
        return $return;       
    }

    /**
     * Deleta um participation
     * @param [type] $request
     * @param [type] $response
     * @param [type] $args
     * @return Response
     */
    public function deleteParticipation($request, $response, $args) {

        $id = (int) $args['id'];

        /**
         * Encontra o participation no Banco
         */ 
        $entityManager = $this->container->get('em');
        $ParticipationsRepository = $entityManager->getRepository('App\Models\Participation');
        $Participation = $ParticipationsRepository->find($id);   

        /**
         * Verifica se existe um participation com a ID informada
         */
        if (!$Participation) {
            $logger = $this->container->get('logger');
            $logger->warning("Participation {$id} Not Found");
            throw new \Exception("Participation not Found", 404);
        }  

        /**
         * Remove a entidade
         */
        $entityManager->remove($Participation);
        $entityManager->flush(); 
        $return = $response->withJson(['msg' => "Deletando o participation {$id}"], 204)
            ->withHeader('Content-type', 'application/json');
        return $return;    
    }

    /**
     * Listagem de Participation by status
     * @param [type] $request
     * @param [type] $response
     * @param [type] $args
     * @return Response
     */
    public function listParticipationStatus($request, $response, $args) {
        $entityManager = $this->container->get('em');
        $ParticipationsRepository = $entityManager->getRepository('App\Models\Participation');
        $Participations = $ParticipationsRepository->findAll();

        foreach ($Participations as $key => $value){

            if(strcmp($value->getStatus, "pending")){
                print_r($value->getStatus);
                $Pending = $value;
            }
        }
        
        $return = $response->withJson($Pending, 200)
            ->withHeader('Content-type', 'application/json');
        return $return;        
    }
    
}