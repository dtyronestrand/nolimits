<?php

namespace App\Http\Controllers\Twill;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Inertia\Response;
use A17\Twill\Http\Controllers\Admin\NestedModuleController as BaseModuleController;

class WebsiteGuideController extends BaseModuleController
{
    protected $moduleName = 'websiteGuides';
    protected $showOnlyParentItemsInBrowsers = true;
    protected $nestedItemsDepth = 1;
    /**
     * This method can be used to enable/disable defaults. See setUpController in the docs for available options.
     */
    protected function setUpController(): void
    {
        $this->enableReorder();
    }

    /**
     * See the table builder docs for more information. If you remove this method you can use the blade files.
     * When using twill:module:make you can specify --bladeForm to use a blade form instead.
     */
    public function index(?int $parentModuleId = null): mixed
    {
        return Inertia::render('Twill/WebsiteGuide/Index', [
            'moduleName' => $this->moduleName,
        ]);
    }

    /**
     * This is an example and can be removed if no modifications are needed to the table.
     */
 
}
