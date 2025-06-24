<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Response; // <-- Keep this for abort_if
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth; // Added import
use Illuminate\Support\Facades\Redirect; // Added import
use Illuminate\Support\Str;

class ProgramController extends Controller
{
    public function index(): InertiaResponse
    {
        return Inertia::render('Programs/Index', [
            'programs' => Program::publishedInListings()
        
                ->get()
                ->map(function ($program) {
                    $program->load('medias', 'blocks');
                    $program->computeBlocks(null, false, App::getLocale()); // Pass locale
                    return $program->only($program->publicAttributes);
                }),
           
        ]);
    }
    public function show(string $slug): InertiaResponse
    {
        // Check for Taekwondo slug and user tkd attribute
                  
      

        // Get the current locale
        $locale = App::getLocale();

    $item = Cache::rememberForever('program.' . $locale . '.' . $slug,
        function () use ($slug, $locale) {
                $pathSegments = explode('/', $slug);
                $leafSlug = array_pop($pathSegments);

                $program = Program::publishedInListings()
                    ->forSlug($leafSlug) // Find by the leaf slug
                    ->first();

                if (!$program) {
                    return null;
                }

                // Verify ancestry if the slug was hierarchical
                $tempParent = $program->parent;
                for ($i = count($pathSegments) - 1; $i >= 0; $i--) {
                    $expectedParentSlug = $pathSegments[$i];

                    if (!$tempParent) {
                        // The slug path indicates a parent, but the program doesn't have one at this level
                        return null;
                    }
                    // Program slugs are not translatable, so direct comparison is fine
                    if ($tempParent->slug !== $expectedParentSlug) {
                        return null;
                    }
                    $tempParent = $tempParent->parent;
                }

                // If tempParent is not null here, it means the slug path was shorter than the program's actual depth
                // e.g., slug was 'parent/child' but program is 'grandparent/parent/child'
                if ($tempParent !== null) {
                    return null;
                }

                // If we reach here, the program is found, published, and its ancestry matches the path.
                $program->load('medias', 'blocks');
            $program->computeBlocks(null, false, $locale); // Pass locale
                return $program;
            });

            // Check for null item after cache retrieval (handles cases where null was cached)
            abort_if($item === null, Response::HTTP_NOT_FOUND, 'Program not found');

            // Dynamically determine the Inertia component name based on the slug
            $componentNameParts = array_map(function ($segment) {
                return Str::studly($segment); // Converts 'kebab-case' to 'PascalCase'
            }, explode('/', $slug));
            $inertiaComponent = 'Programs/' . implode('/', $componentNameParts);

            return Inertia::render($inertiaComponent, [
                'item' => $item->only($item->publicAttributes),
               
                
            ]);
        }
    }