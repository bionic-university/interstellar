<?php

namespace BionicUniversity\Bundle\ProductBundle\DataFixtures\ORM;

use BionicUniversity\Bundle\CatalogBundle\Entity\Category;
use BionicUniversity\Bundle\ProductBundle\Entity\Product;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use League\FactoryMuffin\Facade as FactoryMuffin;

class LoadProduct extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $category = $manager->getRepository('BionicUniversityCatalogBundle:Category')->findOneBy([]);

        FactoryMuffin::loadFactories(__DIR__ . '/factories')->setCustomSetter(function($object, $name, $value){
            $setter = 'set' . ucfirst($name);
            $object->$setter($value);
        });

        for($i = 0; $i < 100; $i++){
            /** @var Product $product */
            $status = $manager->getRepository('BionicUniversityProductBundle:Product\Status')->findOneBy([]);
            $product = FactoryMuffin::instance('BionicUniversity\Bundle\ProductBundle\Entity\Product');
            $product->setCategory($category);
            $product->setStatus($status);
//            $image = md5(time()) . '.jpg';
//            file_put_contents( __DIR__ . '/../../../../../../web/upload/' . $image, file_get_contents($product->getPath()));
            $product -> setPath($product->getPath() . '?ind=' . $i);
            $manager->persist($product);
        }
        $manager->flush();
    }


    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 3;
    }

}