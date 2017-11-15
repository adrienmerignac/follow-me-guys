<?php

namespace FollowMeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FollowMeBundle\Entity\User;
use FollowMeBundle\Entity\Dating;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Exception;
use Doctrine\Common\Collections\Criteria;


class DatingController extends Controller
{
    
    /**
     * @Route("/dating", name="dating")
     */
    public function indexAction(Request $request)
    {
        try 
        {  
            $page = 
               (int) $request->get("page") > 1
            ?  (int) $request->get("page")
            : 1;
            $maxResults = 3;
            $this->get("session")->start();
            if (!$this->get("session")->get("id")) {
                return $this->redirectToRoute("main");
            }
            $criteria = new Criteria;
            $criteria->where($criteria->expr()->gt("datingEnd", time()))
             ->setMaxResults($maxResults);
//              ->orderBy(["datingEnd" => Criteria::ASC]);
             if ($page) {                
                $criteria->setFirstResult(
                    ($page -1) * $maxResults
               );
            }
           
            $em = $this->getDoctrine()->getManager();
            $dating = $em->getRepository(Dating::class)->matching($criteria);
            
            if (!$dating[0] && $page > 1) {
                return $this->redirectToRoute("dating");
            }
        } catch (Exception $e) {
            
        }
         return $this->render('FollowMeBundle:Dating:index.html.twig',
         [
             "dating" => $dating,
             "page" => $page,
             "max" => $maxResults
         ]);
    }
    
    
//     /**
//      * @Route("/modified", name="modified")
//      */
//     public function modified(Request $request) 
//     {
        
//         $clientGMT = $request->headers->get("if-modified-since");
//         $gmt = gmdate('D, d M Y H:i:s T', time());
//        // $date = new \DateTime($gmt);
//         if($clientGMT 
//             && time() - (new \DateTime($clientGMT))->getTimeStamp() < 5) {
//                 $response = new Response();
//                 $response->setStatusCode(304);
//         } else {
//             $response = $this->render('FollowMeBundle:Dating:index.html.twig');
//             $response->setLastModified(new \DateTime($gmt));
//         }
//             $response->setPublic();
//             return $response; 
          
//         }
        
        
                       
//         $fileName = "foo.txt";
//         if (!file_exists($fileName)) {
//             @file_put_contents($fileName, "content");
//         }
        
        
//         $gmt = gmdate('D, d M Y H:i:s T', filemtime($fileName));
        
//         // Si if-modified-since === gmt response vide      
       
//         if ($gmt === $request->headers->get("if-modified-since")) {
//             $response = new Response();
//             $response->setStatusCode(304);
//         } else {
//             $response = $this->render('FollowMeBundle:Dating:index.html.twig');
//         }
//         $response->setLastModified(new \DateTime());
//         $response->setPublic();
//         return $response;        
    //}
    
    
    /**
     * @Route("/etag", name="etag")
     */
//     public function indexEtag(Request $request)
//     {
//         $Etag = md5($request->getRequestUri());
        
//         // if-not-match === etag alors response vide
//         if ("\"" . $Etag . "\"" === current($request->getETags())) {
//             $response = new Response();
//             $response->setStatusCode(304);
//             // sinon response avc un rendu
//         } else {
//             $response = $this->render('FollowMeBundle:Dating:index.html.twig');
//         }
//         $response->setEtag($Etag);
//         $response->setPublic();
//         return $response;
//     }
    
//     /**
//      * @Route("/psr6", name="psr6")
//      */
//     public function indexAction()
//     {
//         $pool = $this->get('cache.app');
//         $item = $pool->getItem('followme.users.three');
//         $item->expiresAfter(3);
//         if (!$item->isHit()) {
//             var_dump("REFREEEEEEEEESSSSSSSSSSSHHHHHHHHHHHH");
//             $user = $this->getDoctrine()
//             ->getManager()
//             ->getRepository(User::class)
//             ->findAll();
//             $item->set($user);
//             $pool->save($item);
//         }
//         $user = $item->get();
        
//         return $this->render('FollowMeBundle:Dating:index.html.twig', array(
//             // ...
//         ));
//     }
}
