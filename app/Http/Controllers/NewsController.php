<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Response; // <-- Keep this for abort_if
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth; // Added import
use Illuminate\Support\Facades\Redirect; // Added import
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index(): InertiaResponse
    {
        return Inertia::render('News/Index', [
            'News' => News::published()
                ->get()
                ->map(function ($news) {
                    $news->load('medias', 'blocks');
                    $news->computeBlocks(App::getLocale());
                    return $news->only($news->publicAttributes);
                }),
           
        ]);
    }
    public function show(string $slug): InertiaResponse
    {
        // Check for Taekwondo slug and user tkd attribute
                  
      

        // Get the current locale
        $locale = App::getLocale();

    $item = Cache::rememberForever('News.' . $locale . '.' . $slug,
        function () use ($slug, $locale) {
                $pathSegments = explode('/', $slug);
                $leafSlug = array_pop($pathSegments);

                $news = News::published()
                    ->forSlug($leafSlug) // Find by the leaf slug
                    ->first();

                if (!$news) {
                    return null;
                }

                // Verify ancestry if the slug was hierarchical
                $tempParent = $news->parent;
                for ($i = count($pathSegments) - 1; $i >= 0; $i--) {
                    $expectedParentSlug = $pathSegments[$i];

                    if (!$tempParent) {
                        // The slug path indicates a parent, but the News doesn't have one at this level
                        return null;
                    }
                    // News slugs are not translatable, so direct comparison is fine
                    if ($tempParent->slug !== $expectedParentSlug) {
                        return null;
                    }
                    $tempParent = $tempParent->parent;
                }

                // If tempParent is not null here, it means the slug path was shorter than the News's actual depth
                // e.g., slug was 'parent/child' but News is 'grandparent/parent/child'
                if ($tempParent !== null) {
                    return null;
                }

                // If we reach here, the News is found, published, and its ancestry matches the path.
                $news->load('medias', 'blocks');
            $news->computeBlocks($locale);
                return $news;
            });

            // Check for null item after cache retrieval (handles cases where null was cached)
            abort_if($item === null, Response::HTTP_NOT_FOUND, 'News not found');

            // Dynamically determine the Inertia component name based on the slug
            $componentNameParts = array_map(function ($segment) {
                return Str::studly($segment); // Converts 'kebab-case' to 'PascalCase'
            }, explode('/', $slug));
            $inertiaComponent = 'News/' . implode('/', $componentNameParts);

            return Inertia::render($inertiaComponent, [
                'item' => $item->only($item->publicAttributes),
               
                
            ]);
        }
    }