<?php

namespace App\DataFixtures;

use App\Entity\BlogPost;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture {
    /**
     * Load data fixtures with the passed EntityManager
     * @param ObjectManager $manager
     * @throws \Exception
     */
    public function load(ObjectManager $manager) {
        $this->loadBlogPosts($manager);
    }

    /**
     * @param ObjectManager $manager
     * @throws \Exception
     */
    public function loadBlogPosts(ObjectManager $manager) {
        // Get the reference
        $user = $this->getReference('user_admin');

        $blogPost = new BlogPost();
        $blogPost->setTitle('A new post from fixtures');
        $blogPost->setPublished(new \DateTime('2019-01-19 14:00:00'));
        $blogPost->setContent('Lorem  ipsum');
        $blogPost->setAuthor($user);
        $blogPost->setSlug('fixtures-post');
        $manager->persist($blogPost);

        $blogPost = new BlogPost();
        $blogPost->setTitle('A new post from fixtures 2');
        $blogPost->setPublished(new \DateTime('2019-01-19 14:00:00'));
        $blogPost->setContent('Lorem  ipsum2');
        $blogPost->setAuthor($user);
        $blogPost->setSlug('fixtures-post-2');

        $manager->persist($blogPost);

        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     */
    public function loadUsers(ObjectManager $manager) {
        $user = new User();
        $user->setUsername('admin');
        $user->setEmail('admin@example.com');
        $user->setName('John Doe');

        // TODO: Do this properly
        $user->setPassword('admin1234$$');

        // Add reference
        $this->addReference('user_admin', $user);

        $manager->persist($user);
        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     */
    public function loadComments(ObjectManager $manager) {

    }
}
