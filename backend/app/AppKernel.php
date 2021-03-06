<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $systemBundles = [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            // Doctrine bundles
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle(),
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
            // Restful
            new FOS\RestBundle\FOSRestBundle(),
            new JMS\SerializerBundle\JMSSerializerBundle(),
            //knp
            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
        ];

        $applicationBundles = [
            new BionicUniversity\Bundle\CatalogBundle\BionicUniversityCatalogBundle(),
            new BionicUniversity\Bundle\CheckoutBundle\BionicUniversityCheckoutBundle(),
            new BionicUniversity\Bundle\WebBundle\BionicUniversityWebBundle(),
            new BionicUniversity\Bundle\ProductBundle\BionicUniversityProductBundle(),
            new BionicUniversity\Bundle\DeliveryBundle\BionicUniversityDeliveryBundle(),
            new BionicUniversity\Bundle\UserBundle\BionicUniversityUserBundle(),
            new BionicUniversity\Bundle\ExportImportBundle\BionicUniversityExportImportBundle(),
        ];

        $environmentBundles = [];
        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $environmentBundles = [
                new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle(),
                new Sensio\Bundle\DistributionBundle\SensioDistributionBundle(),
                new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle(),
                new BW\SecurityCheckerBundle\BWSecurityCheckerBundle(),
            ];
        }

        return array_merge($systemBundles, $applicationBundles, $environmentBundles);
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__ . '/config/config_' . $this->getEnvironment() . '.yml');
    }
}
