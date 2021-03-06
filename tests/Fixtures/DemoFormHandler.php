<?php

declare(strict_types=1);

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nucleos\Form\Tests\Fixtures;

use Nucleos\Form\Handler\AbstractFormHandler;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

final class DemoFormHandler extends AbstractFormHandler
{
    protected function process(FormInterface $form, Request $request): bool
    {
        return true;
    }
}
