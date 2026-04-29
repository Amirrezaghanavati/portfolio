<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Spatie\Tags\Tag;
use Symfony\Component\HttpFoundation\Response;

class PageController extends Controller
{
    private const string RESUME_PATH = 'resume/amirreza-resume.pdf';

    public function home(): Response
    {
        $featuredProjects = Project::query()
            ->where('featured', true)
            ->ordered()
            ->limit(6)
            ->get();

        return response()->view('pages.home', [
            'title' => __('site.page.home.title'),
            'heading' => __('site.page.home.heading'),
            'description' => __('site.page.home.description'),
            'featuredProjects' => $featuredProjects,
        ]);
    }

    public function portfolio(Request $request): Response
    {
        $selectedTags = collect($request->input('tags', []))
            ->filter(fn (mixed $tag): bool => \is_string($tag) && $tag !== '')
            ->values();
        $search = trim((string) $request->input('search', ''));

        $projects = Project::query()
            ->with('tags')
            ->when($selectedTags->isNotEmpty(), function (Builder $query) use ($selectedTags) {
                $query->scopes([
                    'withAnyTags' => [$selectedTags->all()],
                ]);
            })
            ->when($search !== '', function ($query) use ($search) {
                $query->where('title', 'like', '%'.$search.'%');
            })
            ->ordered()
            ->paginate(6)
            ->withQueryString();

        $availableTags = Tag::query()
            ->orderBy('name')
            ->get();

        return response()->view('pages.portfolio', [
            'title' => __('site.page.portfolio.title'),
            'heading' => __('site.page.portfolio.heading'),
            'description' => __('site.page.portfolio.description'),
            'projects' => $projects,
            'availableTags' => $availableTags,
            'selectedTags' => $selectedTags->all(),
            'search' => $search,
        ]);
    }

    public function about(): Response
    {
        return response()->view('pages.about', [
            'title' => __('site.page.about.title'),
            'heading' => __('site.page.about.heading'),
            'description' => __('site.page.about.description'),
        ]);
    }

    public function resume(): Response
    {
        /** @var FilesystemAdapter $publicDisk */
        $publicDisk = Storage::disk('public');

        $resumeUrl = $publicDisk->exists(self::RESUME_PATH)
            ? $publicDisk->url(self::RESUME_PATH)
            : null;

        return response()->view('pages.resume', [
            'title' => __('site.page.resume.title'),
            'heading' => __('site.page.resume.heading'),
            'description' => __('site.page.resume.description'),
            'resumeUrl' => $resumeUrl,
        ]);
    }

    public function services(): Response
    {
        return response()->view('pages.services', [
            'title' => __('site.page.services.title'),
            'heading' => __('site.page.services.heading'),
            'description' => __('site.page.services.description'),
        ]);
    }

    public function contact(): Response
    {
        return response()->view('pages.contact', [
            'title' => __('site.page.contact.title'),
            'heading' => __('site.page.contact.heading'),
            'description' => __('site.page.contact.description'),
        ]);
    }

    public function setLocale(Request $request, string $locale): Response
    {
        $supportedLocales = ['en', 'fa'];
        $resolvedLocale = in_array($locale, $supportedLocales, true) ? $locale : 'en';

        $request->session()->put('locale', $resolvedLocale);
        App::setLocale($resolvedLocale);

        return response()->redirectTo($request->headers->get('referer') ?: route('home'));
    }

    public function downloadResume(): Response
    {
        /** @var FilesystemAdapter $publicDisk */
        $publicDisk = Storage::disk('public');

        if (! $publicDisk->exists(self::RESUME_PATH)) {
            abort(404, __('site.page.resume.unavailable'));
        }

        return response()->download(
            $publicDisk->path(self::RESUME_PATH),
            'Amirreza-Resume.pdf'
        );
    }
}
