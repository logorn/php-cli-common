<?php

/*
 * This file is part of the CLI COMMON package.
 *
 * (c) France Télévisions Editions Numériques <guillaume.postaire@francetv.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ftven\Build\Cli\Extension\Core\DependencyInjection\CompilerPass;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Ftven\Build\Cli\Extension\Core\Command\ConditionalUseInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Application;

/**
 * @author Olivier Hoareau <olivier@phppro.fr>
 */
class AutomaticCommandRegistrationCompilerPass implements CompilerPassInterface
{
    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     *
     * @api
     */
    public function process(ContainerBuilder $container)
    {
        $commands = $container->findTaggedServiceIds(
            'cli.command'
        );

        /** @var Application $application */
        $application = $container->get('application');

        foreach (array_keys($commands) as $id) {
            /** @var Command $command */
            $command = $container->get($id);

            if ($command instanceof ConditionalUseInterface) {
                /** @var ConditionalUseInterface $command */
                if (true !== $command->isUsable()) {
                    continue;
                }
            }

            $application->add($command);
        }
    }
}