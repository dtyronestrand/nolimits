<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Response; // <-- Keep this for abort_if
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use Illuminate\Support\Facades\App; // <-- Import App facade (or use app() helper)

class PageController extends Controller
{
    public function show(string $slug): InertiaResponse
    {
        // Get the current locale
        $locale = App::getLocale(); // Or use app()->getLocale()

        $item = Cache::rememberForever('page.' . $locale . '.' . $slug,
            function () use ($slug, $locale) { // Pass locale into closure if needed inside
                $pathSegments = explode('/', $slug);
                $leafSlug = array_pop($pathSegments);
                $page = Page::publishedInListings()
                ->forSlug($leafSlug)
                ->first();

                if (!$page) {
              return null;
                }
                $tempParent = $page->parent;
                for ($i = count($pathSegments)-1; $i >= 0; $i--){
                    $expectedParentSlug = $pathSegments[$i];

                    if (!$tempParent) {
                        return null;
                    }
                    if ($tempParent->slug !==$expectedParentSlug){
                        return null;
                    }
                    $tempParent = $tempParent->parent;
                }
                if ($tempParent !== null) {
                    return null;
                }
                
                // If we reach here, the page is found, it's publishedInListings, and its ancestry matches the path.
                $page->load('translations', 'medias', 'blocks');
                // Pass locale explicitly if computeBlocks needs it immediately
                // though it defaults to app()->getLocale() anyway
                $page->computeBlocks($locale);
                return $page;
            }
        );

        // Add check for null item after cache retrieval
        abort_if($item === null, Response::HTTP_NOT_FOUND);

        return Inertia::render('Page', [ // Or 'Pages' if that's your component name
            'item' => $item->only($item->publicAttributes),
            'locale' => $locale, // <--- ADD THIS LINE
        ]);
    }
}

