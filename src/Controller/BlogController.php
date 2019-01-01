<?php
/**
 * Created by PhpStorm.
 * User: Pepeg
 * Date: 01/01/2019
 * Time: 17:50
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class BlogController
 * @package App\Controller
 * @Route("/blog")
 */
class BlogController extends AbstractController {
    // Define data here for the moment
    private const POSTS = [
        [
            'id' => 1,
            'slug' => 'hello_world',
            'title' => 'Hello world!',
        ],
        [
            'id' => 2,
            'slug' => 'another_world',
            'title' => 'Hello another world!',
        ],
        [
            'id' => 3,
            'slug' => 'last_world',
            'title' => 'Hello last world!',
        ],
    ];

    /**
     * @Route("/{page}", name="blog_list", defaults={"page": 5}, requirements={"id"="\d+"})
     * @param int $page
     * @param Request $request
     * @return JsonResponse
     */
    public function list($page = 1, Request $request) {
        // Give access to http headers and stuff from the request.
        $limit = $request->get('limit', 10);



        return $this->json(
            [
                'page' => (int)$page,
                'limit' => $limit,
                'data' => array_map(function ($item) {
                    return $this->generateUrl('blog_by_slug', ['slug' => $item['slug']]);
                },self::POSTS)
            ]
        );
    }

    /**
     * requirements to differentiate route parameter types, meaning any number with length 1+
     * @Route("/post/{id)", name="blog_by_id", requirements={"id"="\d+"})
     * @param $id
     * @return JsonResponse
     */
    public function post($id) {
        return $this->json(
            self::POSTS[array_search($id, array_column(self::POSTS, 'id'))]
        );
    }

    /**
     * @Route("/post/{slug}", name="blog_by_slug")
     * @param $slug
     * @return JsonResponse
     */
    public function postBySlug($slug) {
//        return new JsonResponse(
        return $this->json(
            self::POSTS[array_search($slug, array_column(self::POSTS, 'slug'))]
        );
    }
}