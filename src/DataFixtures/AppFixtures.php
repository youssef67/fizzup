<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $p1 = new Product();
        $p1->setProductName('Objectif 200mm')
            ->setImage('image1.jpg')
            ->setPrice(385)
            ->setCarac1('Objectif 35 mm au format DX à grande ouverture')
            ->setCarac2('Moteur SWM ')
            ->setCarac3('Deux modes de mise au point');
        $manager->persist($p1);

        $p2 = new Product();
        $p2->setProductName('Microphone')
            ->setImage('image2.jpg')
            ->setPrice(55)
            ->setCarac1('Microphone statique électret ')
            ->setCarac2('Diaphragme 34 mm')
            ->setCarac3('Directivité cardioïde');
        $manager->persist($p2);

        $p3 = new Product();
        $p3->setProductName('Souris logitech')
            ->setImage('image3.jpg')
            ->setPrice(37.50)
            ->setCarac1('5 DPI Réglables')
            ->setCarac2('2.4G Transmission Sans Fil')
            ->setCarac3('Compatibilité Large');
        $manager->persist($p3);

        $p4 = new Product();
        $p4->setProductName('Polaroid Original')
            ->setImage('image4.jpg')
            ->setPrice(84.50)
            ->setCarac1('Fonction retardateur ')
            ->setCarac2('Lentille de haute qualité')
            ->setCarac3('Flash puissant intégré, Système de flash:');
        $manager->persist($p4);

        $p5 = new Product();
        $p5->setProductName('Drone')
            ->setImage('image5.jpg')
            ->setPrice(114.60)
            ->setCarac1('Systèm GPS')
            ->setCarac2('Caméra 4k HD FPV en temps réel')
            ->setCarac3('Mode de suivi');
        $manager->persist($p5);

        $p6 = new Product();
        $p6->setProductName('Montre connectée')
            ->setImage('image6.jpg')
            ->setPrice(75)
            ->setCarac1('9 Modes Sport & GPS Partagé')
            ->setCarac2('4 Cadrans d\'horloge & Chronomètre')
            ->setCarac3('Notification de Message & Autonomie');
        $manager->persist($p6);

        $p7 = new Product();
        $p7->setProductName('Montre')
            ->setImage('image7.jpg')
            ->setPrice(64)
            ->setCarac1('9 Modes Sport & GPS Partagé')
            ->setCarac2('4 Cadrans d\'horloge & Chronomètre')
            ->setCarac3('Notification de Message & Autonomie');
        $manager->persist($p7);

        $p8 = new Product();
        $p8->setProductName('Objectif 300mm')
            ->setImage('image8.jpg')
            ->setPrice(415)
            ->setCarac1('Objectif 35 mm au format DX à grande ouverture')
            ->setCarac2('Moteur SWM ')
            ->setCarac3('Deux modes de mise au point');
        $manager->persist($p8);

        $p9 = new Product();
        $p9->setProductName('Casque audio')
            ->setImage('image9.jpg')
            ->setPrice(55)
            ->setCarac1('Système à double microphone avec réduction de bruit ')
            ->setCarac2('Trois niveaux de réduction de bruit')
            ->setCarac3('Compatible avec Alexa et l’Assistant Google');
        $manager->persist($p9);

        $p10 = new Product();
        $p10->setProductName('Casque audio noir')
            ->setImage('image10.jpg')
            ->setPrice(385)
            ->setCarac1('Système à double microphone avec réduction de bruit ')
            ->setCarac2('Trois niveaux de réduction de bruit')
            ->setCarac3('Compatible avec Alexa et l’Assistant Google');
        $manager->persist($p10);

        $p11 = new Product();
        $p11->setProductName('appareil photo')
            ->setImage('image11.jpg')
            ->setPrice(89)
            ->setCarac1('Objectif 35 mm au format DX à grande ouverture')
            ->setCarac2('Moteur SWM ')
            ->setCarac3('Deux modes de mise au point');
        $manager->persist($p11);


        $faker = \Faker\Factory::create('fr_FR');

        $products = [$p1, $p2, $p3, $p4, $p5, $p6, $p7, $p8, $p9, $p10, $p10, $p11];
        $userName = ['stephanie', 'Julien', 'Jérome', 'Martin', 'Cindy', 'Marie', 'Leila', 'Najia', 'Victor', 'Sylvie', 'Nicolas', 'Zakaria', 'Maurizio'];
        $images = ['visage1.jpg', 'visage2.jpg', 'visage3.jpg', 'visage4.jpg'];

        foreach ($products as $product) {
            $rand = rand(3, 5);
            for ($i = 1; $i <= $rand; $i++) {
                $comment = new Comment();
                $comment->setEmail($faker->safeEmail())
                    ->setUsername($faker->randomElement($userName))
                    ->setRating($faker->numberBetween($min = 0, $max = 5))
                    ->setCommentary($faker->text(255))
                    ->setImage($faker->randomElement($images))
                    ->setDate($faker->dateTime())
                    ->setProduct($product);
                $manager->persist($comment);
            }
        }

        $manager->flush();
    }
}
