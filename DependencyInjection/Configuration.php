<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Domstor\TemplateBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Description of Configuration
 *
 * @author Dmitry Anikeev <anikeev.dmitry@outlook.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('domstor_template');

        $rootNode
                ->children()
                    ->arrayNode('domstorlib')
                        ->children()
                            ->arrayNode('builder')
                                ->children()
                                    ->integerNode('org_id')->isRequired()->end()
                                    ->integerNode('location_id')->isRequired()->end()
                                    ->arrayNode('cache')
                                        ->children()
                                            ->scalarNode('type')->defaultValue('file')->end()
                                            ->integerNode('time')->defaultValue(86400)->end()
                                            ->scalarNode('uniq_key')->isRequired()->end()
                                            ->arrayNode('options')
                                                ->children()
                                                    ->scalarNode('directory')->isRequired()->end()
                                                ->end()
                                            ->end()
                                        ->end()
                                    ->end()
                                    ->arrayNode('filter')
                                        ->children()
                                            ->scalarNode('template_dir')->isRequired()->end()
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                            ->arrayNode('links')
                                ->prototype('scalar')->isRequired()->end()
                            ->end()
                        ->end()
                    ->end()
                    ->arrayNode('mailer')
                        ->children()
                            ->arrayNode('request')
                                ->children()
                                    ->scalarNode('service')->isRequired()->end()
                                    ->arrayNode('to')
                                        ->isRequired()
                                        ->prototype('scalar')->end()
                                    ->end()
                                    ->scalarNode('from')->isRequired()->end()
                                    ->scalarNode('subject')->isRequired()->end()
                                    ->scalarNode('email_template')->isRequired()->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                    ->arrayNode('title')
                        ->children()
                            ->arrayNode('objects')
                                ->isRequired()
                                ->prototype('scalar')->end()
                            ->end()
                        ->end()
                        ->children()
                            ->arrayNode('objectsHtml')
                                ->isRequired()
                                ->prototype('scalar')->end()
                            ->end()
                        ->end()
                        ->children()
                            ->arrayNode('actions')
                                ->isRequired()
                                ->prototype('scalar')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
        ;

        return $treeBuilder;
    }
}
