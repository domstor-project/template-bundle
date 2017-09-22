<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Domstor\TemplateBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * Description of DomstorTemplateExtension
 *
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */
class DomstorTemplateExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        //$loader->load('config.yml');
        $loader->load('services.yml');
        $loader->load('admin.yml');
        $loader->load('blocks.yml');
        
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        
        $def = $container->getDefinition('domstor.template.block.realtyicons.service');
        $def->replaceArgument(3, $config['domstorlib']['builder']);
        
        $def = $container->getDefinition('domstor.template.block.domstor_filter.service');
        $def->replaceArgument(3, $config['domstorlib']['builder']);
        
        $container->setParameter('domstor.template.domstorlib.domstor_parameters', $config['domstorlib']['builder']);
        $container->setParameter('domstor.template.mailer.request.service_name', 'swiftmailer.mailer.' . $config['mailer']['request']['service']);
        $container->setParameter('domstor.template.mailer.request.to', array_values($config['mailer']['request']['to']));
        $container->setParameter('domstor.template.mailer.request.from', $config['mailer']['request']['from']);
        $container->setParameter('domstor.template.mailer.request.subject', $config['mailer']['request']['subject']);
        $container->setParameter('domstor.template.mailer.request.email_template', $config['mailer']['request']['email_template']);
        
        $def = $container->getDefinition('domstor.template.provider.title');
        $def->replaceArgument(0, $config['title']['objects']);
        $def->replaceArgument(1, $config['title']['objectsHtml']);
        $def->replaceArgument(2, $config['title']['actions']);
        
    }
}
