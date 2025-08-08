<?php

namespace modules\familycouncil;

use Craft;
use modules\familycouncil\twigextensions\Functions;
use yii\base\Module as BaseModule;

/**
 * FamilyCouncil module
 *
 * @method static FamilyCouncil getInstance()
 */
class FamilyCouncil extends BaseModule
{
    public function init(): void
    {
        Craft::setAlias('@modules/familycouncil', __DIR__);

        // Set the controllerNamespace based on whether this is a console or web request
        if (Craft::$app->request->isConsoleRequest) {
            $this->controllerNamespace = 'modules\\familycouncil\\console\\controllers';
        } else {
            $this->controllerNamespace = 'modules\\familycouncil\\controllers';
        }

        parent::init();

        $this->attachEventHandlers();

        // Any code that creates an element query or loads Twig should be deferred until
        // after Craft is fully initialized, to avoid conflicts with other plugins/modules
        Craft::$app->onInit(function() {
            // ...
            Craft::$app->view->registerTwigExtension(new Functions());

        });
    }

    private function attachEventHandlers(): void
    {
        // Register event handlers here ...
        // (see https://craftcms.com/docs/5.x/extend/events.html to get started)
    }
}
