<?php

namespace modules\familycouncil\twigextensions;

use Craft;
use craft\elements\Entry;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class Functions extends AbstractExtension
{
    public function getName(): string
    {
        return 'BaseFunctions';
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('getPersonResponsibilities', [$this, 'getPersonResponsibilities']),
        ];
    }

    public function getPersonResponsibilities(array $memberGoals, array $chores, array $familyNight): ?array
    {
        $name = $memberGoals['person'];
        if (!$name) {
            return null;
        }
        $personalChore = '';
        foreach ($chores as $chore) {
            if ($chore['responsibleParty'] === $name) {
                $personalChore = $chore['chore'] ?? '';
                break;
            }
        }

        if (!$personalChore) {
            $personalChore = '';
        }

        $familyNightJob = '';

        foreach ($familyNight as $fhe) {
            if ($fhe['responsibleParty'] === $name) {
                $familyNightJob = $fhe['responsibility'] ?? 'None';
                break;
            }
        }

        return [
            'name' => $name,
            'goals' => $memberGoals['goals'] ?? [],
            'fhe' => $familyNightJob,
            'chore' => $personalChore,
        ];
    }

}