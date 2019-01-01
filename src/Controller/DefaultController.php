<?php
/**
 * Created by PhpStorm.
 * User: Pepeg
 * Date: 01/01/2019
 * Time: 17:37
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 * Class DefaultController
 * @package App\Controller
 */
class DefaultController extends AbstractController {
    /**
     * @Route("/", name="default_index")
     * actual URL, name
     */
    public function index() {
        return new JsonResponse([
            'action' => 'index',
            'time'   => time()
        ]);
    }
}