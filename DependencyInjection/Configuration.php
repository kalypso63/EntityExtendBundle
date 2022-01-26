<?php

namespace Pj\EntityExtendBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration.
 *
 * @author Paulius Jarmalavičius <paulius.jarmalavicius@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('entity_extend');
        if (method_exists($treeBuilder, 'getRootNode')) {
            $rootNode = $treeBuilder->getRootNode();
        } else {
            // BC layer for symfony/config 4.1 and older
            $rootNode = $treeBuilder->root('entity_extend');
        }
        $rootNode
            ->children()
                ->arrayNode('extended_entities')
                    ->useAttributeAsKey('name')
                    ->prototype('scalar')->end()
                ->end()
                ->arrayNode('non_transient')
                    ->treatNullLike([])
                    ->prototype('scalar')->end()
                    ->defaultValue([])
                ->end()
            ->end();

        return $treeBuilder;
    }
}
